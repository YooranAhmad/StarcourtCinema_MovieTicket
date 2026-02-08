@extends('layouts.app')
@section('content')

    <div class="text-center">
        <p class="text-sm font-bold mt-10 mb-4 uppercase tracking-[0.5em] text-[hsl(var(--primary))]">Now Showing in the Void</p>

        <h1 class="relative inline-block group
           text-5xl sm:text-7xl md:text-8xl lg:text-9xl
           font-black leading-none mb-6 mt-0 md:mt-0
           font-serif tracking-tight
           text-transparent bg-clip-text
           bg-gradient-to-b from-red-600 to-red-900
           text-shadow-glitch">
            <!-- MAIN TEXT -->
            <span class="relative z-10">
                STRANGER THINGS
            </span>

            <!-- RED GLITCH LAYER -->
            <span class="absolute inset-0
                        -z-10
                        text-red-600 opacity-50
                        translate-x-[2px] -translate-y-[1px]
                        crt-flicker
                        mix-blend-screen">
                STRANGER THINGS
            </span>

            <!-- CYAN GLITCH LAYER -->
            <span class="absolute inset-0
                        -z-10
                        text-cyan-400 opacity-50
                        -translate-x-[2px] translate-y-[1px]
                        crt-flicker
                        mix-blend-screen">
                STRANGER THINGS
            </span>
            <div class="scanline absolute inset-0 pointer-events-none"></div>
        </h1>

        <p class="text-md md:text-xl mb-12
                  text-white/80
                  px-4
                  max-w-2xl
                  mx-auto
                  leading-relaxed">
            Experience the thrill of the Upside Down at Starcourt Cinema! Get your tickets now for an unforgettable adventure with Stranger Things.
        </p>
    </div>

    <!--MOVIE LIST-->
    <section class="mx-auto my-20 max-w-7xl">
            <div class="flex items-center gap-4 mx-10 mb-12 border-b border-white/10 pb-4">
                <div class="h-3 w-3 bg-[hsl(var(--primary))] rounded-full animate-pulse"></div>
                <h3 data-replit-metadata="client/src/pages/Home.tsx:53:10" data-component-name="h3" class="text-2xl font-serif text-white tracking-wide">FEATURE PRESENTATIONS</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mx-10">
                <div class="group relative perspective-1000">
                    <a href="{{ route('movie.show', 1) }}">
                        <div class="relative aspect-[2/3] overflow-hidden rounded-lg border border-white/10 bg-zinc-900/50 shadow-2xl transition-all duration-500 group-hover:scale-[1.05] group-hover:shadow-[0_0_30px_rgba(220,38,38,0.4)] group-hover:border-red-600/50 cursor-pointer transform-gpu preserve-3d">
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent z-10 opacity-80 group-hover:opacity-40 transition-opacity duration-500">
                            </div>
                            <img src="images/season1.webp" alt="Season 1" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 filter grayscale group-hover:grayscale-0 contrast-125">
                            <div class="absolute bottom-0 left-0 w-full p-6 z-20 bg-gradient-to-t from-black via-black/80 to-transparent">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-2xl font-serif font-bold text-white leading-tight group-hover:text-[hsl(var(--primary))] transition-colors duration-300">
                                        Season 1: Welcome to Hawkins
                                    </h3>
                                    <span class="px-2 py-1 bg-white/10 text-white text-xs font-mono rounded border border-white/20">
                                        PG-13
                                    </span>
                                </div>
                                <div class="flex flex-col gap-2 font-mono text-sm text-zinc-400">
                                    <div class="flex justify-between items-end">
                                        <span>
                                            115 MIN
                                        </span>
                                        <div class="flex items-center gap-2 text-[hsl(var(--primary))] opacity-0 group-hover:opacity-100 transition-opacity transform translate-x-4 group-hover:translate-x-0">
                                            <span>
                                                BOOK NOW
                                            </span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ticket w-4 h-4">
                                                <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"></path>
                                                <path d="M13 5v2"></path>
                                                <path d="M13 17v2"></path>
                                                <path d="M13 11v2"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="group relative" style="opacity: 1; transform: none;">
                    <a href="{{ route('movie.show', 2) }}">
                        <div class="relative aspect-[2/3] overflow-hidden rounded-lg border border-white/10 bg-zinc-900/50 shadow-2xl transition-all duration-500 group-hover:scale-[1.05] group-hover:shadow-[0_0_30px_rgba(220,38,38,0.4)] group-hover:border-red-600/50 cursor-pointer transform-gpu preserve-3d">
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent z-10 opacity-80 group-hover:opacity-40 transition-opacity duration-500">
                            </div>
                            <img src="images/season2.webp" alt="Season 2" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 filter grayscale group-hover:grayscale-0 contrast-125">
                            <div class="absolute bottom-0 left-0 w-full p-6 z-20 bg-gradient-to-t from-black via-black/80 to-transparent">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-2xl font-serif font-bold text-white leading-tight group-hover:text-[hsl(var(--primary))] transition-colors duration-300">
                                        Season 2: Return to the Upside Down
                                    </h3>
                                    <span class="px-2 py-1 bg-white/10 text-white text-xs font-mono rounded border border-white/20">
                                        R
                                    </span>
                                </div>
                                <div class="flex flex-col gap-2 font-mono text-sm text-zinc-400">
                                    <div class="flex justify-between items-end">
                                        <span>
                                            130 MIN
                                        </span>
                                        <div class="flex items-center gap-2 text-[hsl(var(--primary))] opacity-0 group-hover:opacity-100 transition-opacity transform translate-x-4 group-hover:translate-x-0">
                                            <span>
                                                BOOK NOW
                                            </span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ticket w-4 h-4">
                                                <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"></path>
                                                <path d="M13 5v2"></path>
                                                <path d="M13 17v2"></path>
                                                <path d="M13 11v2"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="group relative" style="opacity: 1; transform: none;">
                    <a href="{{ route('movie.show', 3) }}">
                        <div class="relative aspect-[2/3] overflow-hidden rounded-lg border border-white/10 bg-zinc-900/50 shadow-2xl transition-all duration-500 group-hover:scale-[1.05] group-hover:shadow-[0_0_30px_rgba(220,38,38,0.4)] group-hover:border-red-600/50 cursor-pointer transform-gpu preserve-3d">
                            <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent z-10 opacity-80 group-hover:opacity-40 transition-opacity duration-500">
                            </div>
                            <img src="images/season3.webp" alt="Season 3" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110 filter grayscale group-hover:grayscale-0 contrast-125">
                            <div class="absolute bottom-0 left-0 w-full p-6 z-20 bg-gradient-to-t from-black via-black/80 to-transparent">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-2xl font-serif font-bold text-white leading-tight group-hover:text-[hsl(var(--primary))] transition-colors duration-300">
                                        Season 3: Red Lights, Blue Nights
                                    </h3>
                                    <span class="px-2 py-1 bg-white/10 text-white text-xs font-mono rounded border border-white/20">
                                        PG
                                    </span>
                                </div>
                                <div class="flex flex-col gap-2 font-mono text-sm text-zinc-400">
                                    <div class="flex justify-between items-end">
                                        <span>
                                            98 MIN
                                        </span>
                                        <div class="flex items-center gap-2 text-[hsl(var(--primary))] opacity-0 group-hover:opacity-100 transition-opacity transform translate-x-4 group-hover:translate-x-0">
                                            <span>
                                                BOOK NOW
                                            </span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ticket w-4 h-4">
                                                <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"></path>
                                                <path d="M13 5v2"></path>
                                                <path d="M13 17v2"></path>
                                                <path d="M13 11v2"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
    </section>
@endsection
