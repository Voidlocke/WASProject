<?php

namespace App\Http\Controllers;


use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Requests\StorePaymentRequest;


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

    public function processSuccess(StorePaymentRequest $request, $booking_id)
    {
        $request->validate([
            'card_name' => ['required', 'string', 'max:50', "regex:/^[A-Za-z\s'\-]+$/"],
            'card_number' => 'required|digits:16',
            // MM/YY format
            'expiry_date' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
            'ccv' => 'required|digits:3',
        ]);

        // Fetch the booking from the database
        $booking = Booking::where('booking_id', $booking_id)
        ->where('user_id', auth()->id())
        ->firstOrFail();

        // Prevent replay / double payment
        if ($booking->booking_status === 'confirmed') {
            abort(403, 'Payment already completed');
        }

        $nights = $booking->check_in_date->diffInDays($booking->check_out_date);

        // Calculate Payment
        $roomPrice = $booking->room->prices;
        $subtotal = $roomPrice * $nights;
        $tax = $subtotal * 0.06;
        $total = round($subtotal + $tax, 2);

        Payment::create([
            'booking_id' => $booking_id,
            'amount' => round($total, 2),
            'payment_status' => 'success',
        ]);

        // Update the booking status to 'confirmed'
        $booking->update([
            'booking_status' => 'confirmed',
        ]);

        return redirect()->route('success.shimi')->with('booking_id', $booking_id);
    }
}
