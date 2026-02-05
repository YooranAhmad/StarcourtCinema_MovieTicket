<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function show($id)
    {
        $movies = [
            1 => [
                'title' => 'Season 1: Welcome to Hawkins',
                'duration' => '115 MIN',
                'rating' => 'PG-13',
                'image' => 'images/season1.webp',
                'stars' => 5,
                'description' => 'A boy vanishes. A town begins to unravel.',
                'price' => '$9.99',
                'showtimes' => ['12:00 PM', '3:00 PM', '6:00 PM', '9:00 PM'],
                'trailer' => 'CKtq-bZgS8I',
            ],
            2 => [
                'title' => 'Season 2: Return to the Upside Down',
                'duration' => '130 MIN',
                'rating' => 'R',
                'image' => 'images/season2.webp',
                'stars' => 4,
                'description' => 'The darkness never really left.',
                'price' => '$10.99',
                'showtimes' => ['1:00 PM', '4:00 PM', '7:00 PM', '10:00 PM'],
                'trailer' => 'aXWG_kKDZlY',
            ],
            3 => [
                'title' => 'Season 3: Red Lights, Blue Nights',
                'duration' => '98 MIN',
                'rating' => 'PG',
                'image' => 'images/season3.webp',
                'stars' => 4,
                'description' => 'Summer changes everything.',
                'price' => '$12.99',
                'showtimes' => ['11:00 AM', '2:00 PM', '5:00 PM', '8:00 PM'],
                'trailer' => '74lKim237ZI',
            ],
        ];

        abort_if(!isset($movies[$id]), 404);

        return view('movie', [
            'movie' => $movies[$id],
        ]);
    }
}
