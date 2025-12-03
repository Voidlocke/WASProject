<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminLoginController extends Controller
{
    // Show the admin login form
    public function showLoginForm()
    {
        return view('auth.admin-login');  // Return the admin login view (you'll create this view)
    }

    // Handle the admin login request
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Find the admin by custom 'admin_email' field
        $admin = Admin::where('admin_email', $request->input('email'))->first();

        // If the admin exists and the password matches
        if ($admin && Hash::check($request->input('password'), $admin->admin_pass)) {
            // Log the admin in manually
            Auth::guard('admin')->login($admin);

            // Redirect to the admin dashboard
            return redirect()->route('admin.index');
        }

        // If login fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ]);
    }
}
