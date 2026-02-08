<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\BookingsController;
use Illuminate\Support\Facades\Route;
use App\Models\Bookings;
use Illuminate\Http\Request;

// Dashboard Route

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

// Profile Routes

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Starcourt Routes

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::get('/movie/{id}', [MovieController::class, 'show'])
    ->name('movie.show');

Route::get('/bookings', [BookingsController::class, 'index'])
    ->middleware(['auth'])
    ->name('bookings.index');

// Showtime Routes

Route::middleware('auth')->group(function () {
    Route::get('/booked-seats', [BookingsController::class, 'bookedSeats'])
        ->name('booked-seats');

    Route::post('/bookings', [BookingsController::class, 'store'])
        ->name('bookings.store');

    Route::get('/payment/{id}', [BookingsController::class, 'showPayment'])
        ->name('payment.show');
    
    Route::post('/payment/{id}/process', [BookingsController::class, 'processPayment'])
        ->name('payment.process');
    
    Route::match(['get', 'post'], '/payment/{id}/cancel', [BookingsController::class, 'cancelPayment'])
        ->name('payment.cancel');

    Route::post('/payment/{id}/dev-bypass', [BookingsController::class, 'devBypass'])
        ->name('payment.dev-bypass');
});


require __DIR__.'/auth.php';
