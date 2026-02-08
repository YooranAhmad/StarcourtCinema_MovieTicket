<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookings;

class BookingsController extends Controller
{
    public function store(Request $request)
    {
        // DEBUGGING: Log incoming request
        \Log::info('Booking Request Data:', $request->all());

        // Clean the price first - robust regex to keep only digits
        // This handles Rp, dots, spaces, non-breaking spaces, and any other currency symbols
        $cleanPrice = (float) preg_replace('/[^0-9]/', '', $request->total_price);
        $request->merge(['total_price' => $cleanPrice]);

        try {
            $request->validate([
                'title' => 'required',
                'name' => 'required',
                'email' => 'required|email',
                'showtime' => 'required',
                'seat' => 'required',
                'quantity' => 'required|integer|min:1',
                'total_price' => 'required|numeric',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation Failed:', $e->errors());
            return back()->withErrors($e->errors())->withInput();
        }

        $totalPrice = $cleanPrice;

        $seats = explode(', ', $request->seat);

        foreach ($seats as $seat) {
            $checkSeat = trim($seat);
            
            // Find who holds this seat
            $conflictingBooking = Bookings::where('title', $request->title)
                ->where('showtime', $request->showtime)
                ->where('seat', 'LIKE', "%{$checkSeat}%") // Use LIKE but verify exact match below
                ->whereIn('payment_status', ['pending', 'completed'])
                ->get()
                ->filter(function($b) use ($checkSeat) {
                    // Strict check inside the LIKE results
                    return in_array($checkSeat, array_map('trim', explode(',', $b->seat)));
                })
                ->first();

            if ($conflictingBooking) {
                // Check if it's OURS and PENDING
                if ($conflictingBooking->user_id == auth()->id() && $conflictingBooking->payment_status == 'pending') {
                    // It's our own stale/pending booking. "Overwrite" it by failing the old one.
                    $conflictingBooking->update(['payment_status' => 'failed']);
                    \Log::info("Auto-cancelled previous pending booking {$conflictingBooking->id} for seat {$checkSeat} to allow new booking.");
                    continue; // Allow this seat now
                } else {
                    // It's someone else's or completed
                     \Log::warning("Seat collision detected: $checkSeat");
                     return back()->withErrors("Seat {$seat} already booked");
                }
            }
        }

        $booking = Bookings::create([
            'user_id' => auth()->id(),
            'booking_code' => strtoupper(uniqid('BK-')),
            'title' => $request->title,
            'name' => $request->name,
            'email' => $request->email,
            'showtime' => $request->showtime,
            'seat' => implode(',', $seats), // Store clean comma-separated list
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'payment_status' => 'pending',
        ]);

        return redirect()->route('payment.show', $booking->id);
    }

    public function index()
    {
        $tickets = Bookings::where('user_id', auth()->id())
            ->where('payment_status', 'completed')
            ->latest()
            ->get();

        $pendingBookings = Bookings::where('user_id', auth()->id())
            ->where('payment_status', 'pending')
            ->where('created_at', '>=', now()->subMinutes(15)) // 15 min expiration window
            ->latest()
            ->get();

        // Auto-fail old pending & failed bookings (cleanup)
        Bookings::where('user_id', auth()->id())
            ->where('payment_status', 'pending')
            ->where('created_at', '<', now()->subMinutes(15))
            ->update(['payment_status' => 'failed']);

        return view('bookings', compact('tickets', 'pendingBookings'));
    }

    public function bookedSeats(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'showtime' => 'required',
        ]);

        $rawSeats = Bookings::where('title', $request->title)
            ->where('showtime', $request->showtime)
            ->whereIn('payment_status', ['pending', 'completed']) 
            ->pluck('seat');

        $seats = $rawSeats->flatMap(fn ($s) => array_map('trim', explode(',', $s)))
            ->values();

        return response()->json($seats);
    }

    public function showPayment($id)
    {
        $booking = Bookings::where('id', $id)
            ->where('user_id', auth()->id())
            ->where('payment_status', 'pending')
            ->firstOrFail();

        // Configure Midtrans
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = config('services.midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $booking->booking_code . '-' . rand(), // Unique Order ID
                'gross_amount' => (int) $booking->total_price,
            ),
            'customer_details' => array(
                'first_name' => $booking->name,
                'email' => $booking->email,
            ),
        );

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }

        // Calculate remaining time in seconds
        $createdAt = $booking->created_at;
        $expiresAt = $createdAt->addMinutes(15);
        $remainingTime = now()->diffInSeconds($expiresAt, false);
        
        return view('payment', compact('booking', 'snapToken', 'remainingTime'));
    }

    public function processPayment(Request $request, $id)
    {
        $json = json_decode($request->get('json_callback'));
        
        $booking = Bookings::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($json->transaction_status == 'settlement' || $json->transaction_status == 'capture') {
             $booking->update([
                'payment_status' => 'completed',
                'payment_method' => $json->payment_type,
                'paid_at' => now(),
            ]);
            return redirect()->route('bookings.index')->with('success', 'Payment successful! Your ticket has been confirmed.');
        } elseif ($json->transaction_status == 'pending') {
            return redirect()->route('bookings.index')->with('warning', 'Payment is pending. Please complete your payment.');
        } else {
             $booking->update(['payment_status' => 'failed']);
             return redirect()->route('movie.show', 1)->with('error', 'Payment failed or cancelled.');
        }
    }

    public function cancelPayment($id)
    {
        $booking = Bookings::where('id', $id)
            ->where('user_id', auth()->id())
            ->where('payment_status', 'pending')
            ->firstOrFail();

        $booking->update(['payment_status' => 'failed']);

        // Find movie ID to redirect back correctly
        // Helper map since we don't have movie_id in db (legacy design) -> actually we do have movie_id column? 
        // Note: The migration file 2026_02_08_090808... might have it? 
        // Looking at store() we only save title. But wait, we can map title back to ID.
        // Or simpler: just use title to find it if we had a database of movies.
        // For now, based on MovieController hardcoded array:
        $movieId = 1; // Default
        if (str_contains($booking->title, 'Season 2')) $movieId = 2;
        if (str_contains($booking->title, 'Season 3')) $movieId = 3;

        return redirect()->route('movie.show', $movieId)->with('error', 'Payment cancelled.');
    }

    public function devBypass(Request $request, $id)
    {
        $request->validate(['dev_password' => 'required']);

        if ($request->dev_password !== 'HAWKINS') { // Hardcoded dev password
            return back()->with('error', 'Access Denied: Invalid Security Clearance Code.');
        }

        $booking = Bookings::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $booking->update([
            'payment_status' => 'completed',
            'payment_method' => 'DEV_BYPASS',
            'paid_at' => now(),
        ]);

        return redirect()->route('bookings.index')->with('success', 'Dev Bypass Successful: Ticket confirmed.');
    }
}
