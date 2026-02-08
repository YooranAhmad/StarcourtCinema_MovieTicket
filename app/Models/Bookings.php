<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    protected $fillable = [
        'user_id',
        'booking_code',
        'title',
        'name',
        'email',
        'showtime',
        'seat',
        'quantity',
        'total_price',
        'payment_status',
        'payment_method',
        'paid_at',
    ];
}
