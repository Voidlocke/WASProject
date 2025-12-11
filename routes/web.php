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


Route::resource('reviews', ReviewController::class);
Route::resource('bookings', BookingController::class);

Route::get('/', function () {
    return view('mainpage');
})->name('mainpage');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/reviews', function () {
    return view('reviews');
});

Route::get('/rooms', function () {
    return view('rooms');
});
Route::get('/contact', function () {
    return view('contact');
});

// Admin login routes (public - with rate limiting for security)
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login'])
    ->middleware('throttle:5,1')  // 5 attempts per minute
    ->name('admin.login.submit');

// Debug route - remove after testing
Route::get('/admin/check', function() {
    return [
        'is_authenticated' => auth()->guard('admin')->check(),
        'user' => auth()->guard('admin')->user(),
        'id' => auth()->guard('admin')->id(),
    ];
});

Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');



Route::post('register', [RegisterController::class, 'register'])->name('register.submit');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', function () {
        return view('mainpage');
    })->name('home');
});



Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');

Route::post('/payment', [PaymentController::class, 'index'])->name('payment');
Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::post('/payment/{booking_id}', [PaymentController::class, 'processSuccess'])->name('payment.submit');
Route::get('/success', [PaymentController::class, 'shimi'])->name('success.shimi');

Route::middleware(['auth'])->get('/profile', function () {
    return view('profile.show');
})->name('profile.show');

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
Route::put('/profile/photo', [ProfileController::class, 'updateProfilePhoto'])->name('profile.updatePhoto');
Route::delete('/cancel-booking/{booking_id}', [ProfileController::class, 'cancelBooking'])->name('profile.cancelBooking');

// Admin routes - Protected with isAdmin middleware
Route::middleware(['isAdmin'])->prefix('admin')->group(function () {
    // Admin dashboard
    Route::get('/', [BookingController::class, 'index'])->name('admin.index');

    // Admin logout
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

    // Admin management
    Route::post('/details', [AdminController::class, 'admindetail'])->name('admin.details');

    // Admin booking management
    Route::post('/bookings/store', [BookingController::class, 'adminStore'])->name('bookings.adminstore');
    Route::get('/bookings/{booking_id}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
    Route::put('/bookings/{booking_id}', [BookingController::class, 'update'])->name('bookings.update');
    Route::delete('/bookings/{booking_id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
});

//get room data from database for rooms page
//Route::get('/rooms', [BookingController::class, 'rooms'])->name('rooms');
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms');

Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('payment', [PaymentController::class, 'index'])->name('payment');

Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');


