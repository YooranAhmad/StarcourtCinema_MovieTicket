<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\BookingsController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');


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

Route::get('/movie', function () {
    return view('movie');
})->name('movie');

Route::get('/booking', function () {
    return view('booking');
})->name('booking');

Route::get('/movie/{id}', [MovieController::class, 'show'])
->name('movie.show');

Route::get('/movie/{slug}', [MovieController::class, 'show'])
    ->name('movie.show');

Route::post('/bookings', [BookingsController::class, 'store'])
    ->name('bookings.store');

Route::get('/bookings', [BookingsController::class, 'index'])
    ->name('bookings.index');

require __DIR__.'/auth.php';
