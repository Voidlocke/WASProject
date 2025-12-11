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

        // Debug logging
        \Log::info('Admin login attempt', [
            'email' => $request->input('email'),
            'admin_found' => $admin ? 'yes' : 'no',
            'admin_id' => $admin ? $admin->admin_id : null,
        ]);

        // If the admin exists and the password matches
        if ($admin && Hash::check($request->input('password'), $admin->admin_pass)) {
            // Store admin ID in session manually
            $request->session()->put('admin_id', $admin->admin_id);
            $request->session()->put('admin_authenticated', true);

            // Also use Laravel's auth system
            Auth::guard('admin')->login($admin, false);

            // Debug: Check if login worked
            \Log::info('Admin authenticated after login', [
                'is_authenticated' => auth()->guard('admin')->check(),
                'admin_id' => auth()->guard('admin')->id(),
                'session_admin_id' => $request->session()->get('admin_id'),
                'session_id' => $request->session()->getId(),
            ]);

            // Redirect to the admin dashboard
            return redirect()->route('admin.index');
        }

        // If login fails, redirect back with an error message
        \Log::warning('Admin login failed', ['email' => $request->input('email')]);
        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ]);
    }

    // Handle admin logout
    public function logout(Request $request)
    {
        // Logout admin using the 'admin' guard
        Auth::guard('admin')->logout();

        // Clear manual session data
        $request->session()->forget('admin_id');
        $request->session()->forget('admin_authenticated');

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect to homepage
        return redirect()->route('mainpage')->with('success', 'You have been logged out successfully.');
    }
}
