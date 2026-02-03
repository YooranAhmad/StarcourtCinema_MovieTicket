@extends('layouts.app')

@section('content')
<header class="fixed top-0 w-full z-50 bg-background/80 backdrop-blur-md border-b border-white/5 h-16 flex items-center px-4 md:px-6">
    <div class="max-w-7xl mx-auto w-full flex justify-between items-center">
        <!--LEFT: LOGO-->
        <a href="/" class="font-serif text-[hsl(var(--primary))] text-xl md:text-2xl font-black tracking-tighter hover:scale-105 transition-transform">
            STARCOURT<span class="text-white">CINEMA
            </span>
        </a>

        <!--RIGHT: NAV-->
        <div class="flex gap-4 md:gap-6 text-[10px] md:text-sm font-mono text-zinc-400">
            <a href="/" class="hover:text-[hsl(var(--primary))] transition-colors">
                MOVIES
            </a>
            <a href="{{ route('bookings') }}" class="hover:text-[hsl(var(--primary))] transition-colors">
                MY_TICKETS
            </a>
        </div>
    </div>
</header>

<body class="bg-[hsl(var(--background))] text-white min-h-screen pt-16"> 
    <section class="max-w-6xl mx-auto my-20 px-6">
        <a href="/" class="gap-2 text-[10px] md:text-sm font-mono text-zinc-400 uppercase hover:text-[hsl(var(--primary))] transition-colors mb-8 inline-flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left w-4 h-4">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>Back to Listings
        </a>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            
            <img src="{{ asset($movie['image']) }}"
                class="rounded-xl shadow-2xl border border-white/10">

            <div>
                <h1 class="text-5xl font-serif text-primary mb-4">
                    {{ $movie['title'] }}
                </h1>

                <p class="text-zinc-400 mb-6">
                    {{ $movie['description'] }}
                </p>

                <div class="flex gap-6 font-mono text-sm text-zinc-300">
                    <span>{{ $movie['duration'] }}</span>
                    <span class="px-2 py-1 border border-white/20 rounded">
                        {{ $movie['rating'] }}
                    </span>
                </div>

                <a href="#" class="inline-block mt-8 px-6 py-3 bg-[hsl(var(--primary))] text-white font-bold rounded hover:scale-105 transition">
                    BOOK TICKET
                </a>
                
                
            </div>
        </div>
    </section>
</body>
@endsection
