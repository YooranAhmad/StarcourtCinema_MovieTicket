<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'duration',
        'rating',
        'image',
        'stars',
        'description',
        'price',
        'showtimes',
        'trailer',
        'slug',
    ];
}
