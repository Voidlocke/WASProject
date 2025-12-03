<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Booking;

class AdminController extends Controller
{
    public function index()
    {
        // Fetch all admin details from the database
        $admins = Admin::all(); // Replace with your desired logic to get admin details
        $bookings = Booking::all(); // Optional: if you want to display booking data

        // Return the view with data (adjust 'admin' to the name of your view file)
        return view('admin', compact('admins', 'bookings'));
    }

    public function admindetail(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|email|unique:admin,admin_email',
            'admin_pass' => 'required|string|min:6',
            'booking_id' => 'required|integer|exists:bookings,id',
        ]);

        // Create a new admin record in the database
        Admin::create([
            'admin_name' => $request->admin_name,
            'admin_email' => $request->admin_email,
            'admin_pass' => bcrypt($request->admin_pass), // Hash the password
            'booking_id' => $request->booking_id,
        ]);

        // Redirect or return a success response
        return redirect()->route('admin.index')->with('success', 'Admin details added successfully.');
    }
}
