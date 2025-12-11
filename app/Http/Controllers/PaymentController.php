<?php

namespace App\Http\Controllers;


use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'booking_id' => session('booking_id'),
            'room_id' => session('room_id'),
            'room_type' => session('room_type'),
            'check_in_date' => session('check_in_date'),
            'check_out_date' => session('check_out_date'),
            'price' => session('price'),
            'guest_count' => session('guest_count'),
        ];
        return view('payment', ['data' => $data, 'booking_id' => session('booking_id')]);  // payment.blade.php
    }
    public function shimi()
    {
        return view('success');  // payment.blade.php
    }

    public function processSuccess(Request $request, $booking_id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'card_name' => 'required|string|max:50',
            'card_number' => 'required|numeric',
            // MM/YY format
            'expiry_date' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
            'ccv' => 'required|digits:3',
        ]);

        // Fetch the booking from the database
        $booking = Booking::findOrFail($booking_id);

        Payment::create([
            'booking_id' => $booking_id,
            'amount' => (double) $request->amount,
            'card_name' => $request->card_name,
            'card_number' => $request->card_number,
            'expiry_date' => $request->expiry_date,
            'ccv' => $request->ccv,
            'payment_status' => 'success',
        ]);

        // Update the booking status to 'confirmed'
        $booking->update([
            'booking_status' => 'confirmed',
        ]);

        return redirect()->route('success.shimi')->with('booking_id', $booking_id);
    }
}
