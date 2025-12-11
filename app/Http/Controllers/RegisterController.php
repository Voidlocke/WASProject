<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Validate the registration data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users', // Email should be unique
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                // at least 1 letter and 1 digit
                'regex:/^(?=.*[A-Za-z])(?=.*\d).{8,}$/',
            ],
        ],
        [
            // Custom message for your regex rule:
            'password.regex' => 'Password must be at least 8 characters and contain letters and numbers.',
            // (optional) Override default min message too:
            'password.min'   => 'Password must be at least 8 characters and contain letters and numbers.',
        ]
            );

        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create the new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Hash the password before storing it
        ]);

        // Optionally log the user in automatically after registration
        auth()->login($user);

        // Redirect to the login page after successful registration
        return redirect()->route('login')->with('status', 'Registration successful! You can now log in.');
    }
}

