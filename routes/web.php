<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\MovieController;

//HREF ROUTES
Route::get('/', function () {
    return view('home');
});

Route::get('/bookings', function () {
    return view('bookings');
})->name('bookings');

Route::get('/movie/{id}', [MovieController::class, 'show'])
->name('movie.show');

