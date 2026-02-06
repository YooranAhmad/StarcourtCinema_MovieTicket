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


}
