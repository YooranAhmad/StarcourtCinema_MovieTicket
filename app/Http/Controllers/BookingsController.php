<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookings;

class BookingsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'showtime' => 'required',
            'seat' => 'required',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required',
        ]);

        $totalPrice = (float) str_replace(['$', ','], '', $request->total_price);

        $seats = explode(', ', $request->seat);

        foreach ($seats as $seat) {
            $exists = Bookings::where('title', $request->title)
                ->where('showtime', $request->showtime)
                ->where('seat', 'LIKE', "%{$seat}%")
                ->exists();

            if ($exists) {
                return back()->withErrors("Seat {$seat} already booked");
            }
        }

        $booking = Bookings::create([
            'booking_code' => strtoupper(uniqid('BK-')),
            'title' => $request->title,
            'name' => $request->name,
            'email' => $request->email,
            'showtime' => $request->showtime,
            'seat' => $request->seat,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
        ]);

        return redirect()->route('bookings.index')->with('success', 'Ticket booked successfully!');
    }

    public function index()
    {
        $tickets = Bookings::latest()->get();
        return view('bookings', compact('tickets'));
    }

    public function bookedSeats(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'showtime' => 'required',
        ]);

        $seats = Bookings::where('title', $request->title)
            ->where('showtime', $request->showtime)
            ->pluck('seat')
            ->flatMap(fn ($s) => explode(',', $s))
            ->values();

        return response()->json($seats);
    }

}
