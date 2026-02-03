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
    <div class="text-center">

        <h1 class="relative inline-block group
           text-7xl md:text-7xl lg:text-7xl
           font-black leading-none mb-6 mt-15
           font-serif tracking-tight
           text-transparent bg-clip-text
           bg-gradient-to-b from-red-600 to-red-900
           text-shadow-glitch">
            <!-- MAIN TEXT -->
            <span class="relative z-10">
                MY TICKETS
            </span>

            <!-- RED GLITCH LAYER -->
            <span class="absolute inset-0
                        -z-10
                        text-red-600 opacity-50
                        translate-x-[2px] -translate-y-[1px]
                        crt-flicker
                        mix-blend-screen">
                MY TICKETS
            </span>

            <!-- CYAN GLITCH LAYER -->
            <span class="absolute inset-0
                        -z-10
                        text-cyan-400 opacity-50
                        -translate-x-[2px] translate-y-[1px]
                        crt-flicker
                        mix-blend-screen">
                MY TICKETS
            </span>
            <div class="scanline absolute inset-0 pointer-events-none"></div>
        </h1>

        <p class="text-md md:text-xl mb-12
                  text-white/80
                  px-4
                  max-w-2xl
                  mx-auto
                  leading-relaxed">
            Here you can view and manage your booked tickets.
        </p>
    </div>

    <div class="max-w-3xl mx-auto px-4">
         <div class="border border-white/10 rounded-lg p-6 mb-6 bg-white/1">
            <div class="flex items-center gap-2 mb-4 text-[hsl(var(--primary))]">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ticket w-4 h-4">
                    <path d="M2 9v6a2 2 0 0 0 0 4h1a2 2 0 0 1 2 2v1h14v-1a2 2 0 0 1 2-2h1a2 2 0 0 0 0-4v-6a2 2 0 0 0 0-4h-1a2 2 0 0 1-2-2v-1H5v1a2 2 0 0 1-2 2H2a2 2 0 0 0 0 4Z"></path>
                    <line x1="7" x2="17" y1="15" y2="15"></line>
                    <line x1="7" x2="17" y1="9" y2="9"></line>
                </svg>
                <h2 class="text-white text-xl font-semibold uppercase">Active Reservations</h2>
            </div>
            
            <div class="relative border border-white/10 rounded-lg p-4 text-white/70 bg-[hsl(var(--background))]">
                <div class="flex justify-between items-center">
                    <div class="flex flex-col">
                        <!--LEFT-SIDE: BOOKING INFO-->
                        <h2 class="text-md font-semibold mb-2 text-[hsl(var(--primary))] uppercase">No Active Reservations</h2>
                        <div class="text-xs text-zinc-500 flex items-center gap-2 mb-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-3 h-3">
                            <path d="M8 2v4"></path>
                            <path d="M16 2v4"></path>
                            <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                            <path d="M3 10h18"></path>
                            </svg>
                            14:00
                        </div>

                        <div class="text-xs text-zinc-500 flex items-center gap-2 uppercase">
                            Theater: Starcourt Cinema 1
                        </div>
                    </div>
                    <div class="flex items-center gap-6 text-right">
                        <div class="space-y-1">
                            <div class="text-[10px] text-zinc-600 uppercase">
                                ADMIT 1
                            </div>
                            <div class="text-white font-bold tracking-widest uppercase">
                                Yooran
                            </div>
                        </div>
                        <div class="w-12 h-12 bg-white/5 rounded border border-white/10 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ticket w-4 h-4">
                                <path d="M2 9v6a2 2 0 0 0 0 4h1a2 2 0 0 1 2 2v1h14v-1a2 2 0 0 1 2-2h1a2 2 0 0 0 0-4v-6a2 2 0 0 0 0-4h-1a2 2 0 0 1-2-2v-1H5v1a2 2 0 0 1-2 2H2a2 2 0 0 0 0 4Z"></path>
                                <line x1="7" x2="17" y1="15" y2="15"></line>
                                <line x1="7" x2="17" y1="9" y2="9"></line>
                            </svg>
                        </div>
                    </div>    
                </div>
                

            </div>
    </div>

    
</body>
@endsection
