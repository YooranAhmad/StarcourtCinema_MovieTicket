<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\AdminController;
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

Route::get('/', [MovieController::class, 'index']);

Route::get('/home', [MovieController::class, 'index'])
    ->name('home');

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

// Admin Routes

Route::middleware(['auth','admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');
    
    Route::get('/admin/bookings', [AdminController::class, 'bookings'])
        ->name('admin.bookings');
    Route::delete('/admin/bookings/{id}', [AdminController::class, 'destroyBooking'])
        ->name('admin.bookings.destroy');
    
    Route::get('/admin/users', [AdminController::class, 'users'])
        ->name('admin.users');
    Route::get('/admin/users/create', [AdminController::class, 'createUser'])
        ->name('admin.users.create');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])
        ->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [AdminController::class, 'editUser'])
        ->name('admin.users.edit');
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])
        ->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroyUser'])
        ->name('admin.users.destroy');

    // Movies CRUD
    Route::get('/admin/movies', [AdminController::class, 'movies'])
        ->name('admin.movies');
    Route::get('/admin/movies/create', [AdminController::class, 'createMovie'])
        ->name('admin.movies.create');
    Route::post('/admin/movies', [AdminController::class, 'storeMovie'])
        ->name('admin.movies.store');
    Route::get('/admin/movies/{id}/edit', [AdminController::class, 'editMovie'])
        ->name('admin.movies.edit');
    Route::put('/admin/movies/{id}', [AdminController::class, 'updateMovie'])
        ->name('admin.movies.update');
    Route::delete('/admin/movies/{id}', [AdminController::class, 'destroyMovie'])
        ->name('admin.movies.destroy');
});

require __DIR__.'/auth.php';
