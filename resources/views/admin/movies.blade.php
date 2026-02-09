@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto px-4 md:px-6 mb-12">
        <div class="mb-8 border-b border-white/10 pb-6">
            <p class="text-xs font-mono text-[hsl(var(--primary))] uppercase tracking-[0.3em] mb-2">Admin_Management</p>
            <h1 class="text-4xl md:text-6xl font-serif font-black text-white tracking-tight italic">
                MOVIES_CONTROL
            </h1>
        </div>

        <!-- Info Panel -->
        <div class="glass-panel rounded-lg p-6 mb-8 border border-yellow-500/30">
            <div class="flex items-center gap-3 text-yellow-500">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
                <p class="font-mono text-sm">
                    Movies are currently hardcoded in the system. This page displays the movie configuration overview.
                </p>
            </div>
        </div>

        <!-- Movie Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @php
                $hardcodedMovies = [
                    [
                        'id' => 1,
                        'title' => 'Season 1: Welcome to Hawkins',
                        'rating' => 'PG-13',
                        'duration' => '115 MIN',
                        'price' => 50000,
                        'image' => 'images/season1.webp',
                        'showtimes' => ['10:00', '13:00', '16:00', '19:00']
                    ],
                    [
                        'id' => 2,
                        'title' => 'Season 2: Return to the Upside Down',
                        'rating' => 'R',
                        'duration' => '130 MIN',
                        'price' => 60000,
                        'image' => 'images/season2.webp',
                        'showtimes' => ['11:00', '14:00', '17:00', '20:00']
                    ],
                    [
                        'id' => 3,
                        'title' => 'Season 3: Red Lights, Blue Nights',
                        'rating' => 'PG',
                        'duration' => '98 MIN',
                        'price' => 45000,
                        'image' => 'images/season3.webp',
                        'showtimes' => ['12:00', '15:00', '18:00', '21:00']
                    ]
                ];
            @endphp

            @foreach($hardcodedMovies as $movie)
            <div class="glass-panel rounded-lg overflow-hidden border border-white/10 hover:border-red-500/50 transition-all group">
                <!-- Movie Poster -->
                <div class="relative aspect-[2/3] overflow-hidden bg-zinc-900">
                    <img src="{{ asset($movie['image']) }}" alt="{{ $movie['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-2 right-2 px-2 py-1 bg-black/80 text-white text-xs font-mono rounded border border-white/20">
                        {{ $movie['rating'] }}
                    </div>
                </div>

                <!-- Movie Details -->
                <div class="p-4">
                    <h3 class="text-white font-serif text-lg font-bold mb-2">{{ $movie['title'] }}</h3>
                    
                    <div class="space-y-2 text-xs font-mono">
                        <div class="flex justify-between text-zinc-400">
                            <span>Duration:</span>
                            <span class="text-white">{{ $movie['duration'] }}</span>
                        </div>
                        <div class="flex justify-between text-zinc-400">
                            <span>Price:</span>
                            <span class="text-green-500 font-bold">Rp {{ number_format($movie['price'], 0, ',', '.') }}</span>
                        </div>
                        <div class="pt-2 border-t border-white/10">
                            <p class="text-zinc-500 mb-1">Showtimes:</p>
                            <div class="flex flex-wrap gap-1">
                                @foreach($movie['showtimes'] as $time)
                                    <span class="px-2 py-0.5 bg-red-500/20 text-red-500 rounded text-[10px]">{{ $time }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Note -->
        <div class="mt-8 glass-panel rounded-lg p-4 border border-zinc-800">
            <p class="text-zinc-500 text-xs font-mono text-center">
                To modify movies, edit the MovieController or create a database migration for dynamic movie management.
            </p>
        </div>
    </div>
@endsection
