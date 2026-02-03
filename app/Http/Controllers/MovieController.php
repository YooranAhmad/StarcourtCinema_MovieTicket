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
                'description' => 'A boy vanishes. A town begins to unravel.',
            ],
            2 => [
                'title' => 'Season 2: Return to the Upside Down',
                'duration' => '130 MIN',
                'rating' => 'R',
                'image' => 'images/season2.webp',
                'description' => 'The darkness never really left.',
            ],
            3 => [
                'title' => 'Season 3: Red Lights, Blue Nights',
                'duration' => '98 MIN',
                'rating' => 'PG',
                'image' => 'images/season3.webp',
                'description' => 'Summer changes everything.',
            ],
        ];

        abort_if(!isset($movies[$id]), 404);

        return view('movie', [
            'movie' => $movies[$id],
        ]);
    }
}
