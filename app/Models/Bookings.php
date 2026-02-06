<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    protected $fillable = [
        'booking_code',
        'title',
        'name',
        'email',
        'showtime',
        'seat',
        'quantity',
        'total_price',
    ];
}
