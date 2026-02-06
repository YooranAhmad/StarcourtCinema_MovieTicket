<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\MovieController;

//HREF ROUTES
Route::get('/', function () {
    return view('home');
});

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
