<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard (main page).
     *
     *
     */
    public function index()
    {
        return view('mainpage');
        // Return the view that represents your homepage

        return view('rooms');
    }
}


