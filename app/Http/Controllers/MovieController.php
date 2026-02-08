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
                'description' => 'In the small town of Hawkins, Indiana, a group of friends stumbles upon a terrifying supernatural world known as the Upside Down. When one of their own vanishes, they embark on a dangerous quest to find him, uncovering dark secrets and facing terrifying creatures along the way.',
                'price' => 50000,
                'showtimes' => ['12:00 PM', '3:00 PM', '6:00 PM', '9:00 PM'],
                'trailer' => 'CKtq-bZgS8I',
                'id' => 1,
            ],
            2 => [
                'title' => 'Season 2: Return to the Upside Down',
                'duration' => '130 MIN',
                'rating' => 'R',
                'image' => 'images/season2.webp',
                'stars' => 4,
                'description' => 'A year after the first incident, the residents of Hawkins try to move on, but the darkness never truly left. A new, larger threat emerges from the Upside Down, forcing the group to reunite and face their fears once again.',
                'price' => 60000,
                'showtimes' => ['1:00 PM', '4:00 PM', '7:00 PM', '10:00 PM'],
                'trailer' => 'aXWG_kKDZlY',
                'id' => 2,
            ],
            3 => [
                'title' => 'Season 3: Red Lights, Blue Nights',
                'duration' => '98 MIN',
                'rating' => 'PG',
                'image' => 'images/season3.webp',
                'stars' => 4,
                'description' => 'As Hawkins enters a new summer, the Starcourt Mall becomes the town\'s new hangout spot. But beneath the surface, a sinister Russian plot threatens to unleash the Upside Down once more, forcing the group to confront their biggest challenge yet.',
                'price' => 75000,
                'showtimes' => ['11:00 AM', '2:00 PM', '5:00 PM', '8:00 PM'],
                'trailer' => '74lKim237ZI',
                'id' => 3,
            ],
        ];

        abort_if(!isset($movies[$id]), 404);

        return view('movie', [
            'movie' => $movies[$id],
        ]);
    }
}
