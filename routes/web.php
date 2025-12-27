<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Landing / main page
Route::get('/', function () {
    return view('mainpage');
})->name('mainpage');

// Home
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rooms page (ONLY ONE definition)
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms');

// Contact page
Route::get('/contact', function () {
    return view('contact');
});

// Reviews (public index only)
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');

// User registration
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');

// Login page
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');

Route::middleware(['auth'])->group(function () {

    // Bookings (CRUD)
    Route::resource('bookings', BookingController::class);

    // Payment flow
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
    Route::post('/payment/{booking_id}', [PaymentController::class, 'processSuccess'])->name('payment.submit');
    Route::get('/success', [PaymentController::class, 'shimi'])->name('success.shimi');

    // Reviews (except index)
    Route::resource('reviews', ReviewController::class)->except(['index']);

    // User profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile/photo', [ProfileController::class, 'updateProfilePhoto'])->name('profile.updatePhoto');
    Route::delete('/cancel-booking/{booking_id}', [ProfileController::class, 'cancelBooking'])->name('profile.cancelBooking');
});

/*
|--------------------------------------------------------------------------
| Admin Authentication
|--------------------------------------------------------------------------
*/

// Admin login
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('admin.login.submit');

/*
|--------------------------------------------------------------------------
| Admin Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['isAdmin'])->prefix('admin')->group(function () {

    // Admin dashboard
    Route::get('/', [BookingController::class, 'index'])->name('admin.index');

    // Admin logout
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    // Admin details
    Route::post('/details', [AdminController::class, 'admindetail'])->name('admin.details');

    // Admin booking management
    Route::post('/bookings/store', [BookingController::class, 'adminStore'])->name('bookings.adminstore');
    Route::get('/bookings/{booking_id}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{booking_id}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{booking_id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});

/*
|--------------------------------------------------------------------------
| Debug (OPTIONAL – REMOVE BEFORE SUBMISSION)
|--------------------------------------------------------------------------
*/

//get room data from database for rooms page
//Route::get('/rooms', [BookingController::class, 'rooms'])->name('rooms');
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms');

Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('payment', [PaymentController::class, 'index'])->name('payment');

Route::middleware(['auth'])->get(
    '/booking/download/{filename}',
    [BookingController::class, 'downloadFile']
)->name('booking.download');



// Route::get('/admin/check', function () {
//     return [
//         'is_authenticated' => auth()->guard('admin')->check(),
//         'user' => auth()->guard('admin')->user(),
//         'id' => auth()->guard('admin')->id(),
//     ];
// });
