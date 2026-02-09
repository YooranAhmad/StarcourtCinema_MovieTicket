<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="icon" type="image/png" href="/favicon.png" />
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&family=Fira+Code:wght@300..700&family=Geist+Mono:wght@100..900&family=Geist:wght@100..900&family=IBM+Plex+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=IBM+Plex+Sans:ital,wght@0,100..700;1,100..700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Lora:ital,wght@0,400..700;1,400..700&family=Merriweather:ital,opsz,wght@0,18..144,300..900;1,18..144,300..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Outfit:wght@100..900&family=Oxanium:wght@200..800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&family=Roboto:ital,wght@0,100..900;1,100..900&family=Source+Code+Pro:ital,wght@0,200..900;1,200..900&family=Source+Serif+4:ital,opsz,wght@0,8..60,200..900;1,8..60,200..900&family=Space+Grotesk:wght@300..700&family=Space+Mono:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
      <title>Stranger Things Movie Tickets</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased overflow-x-hidden relative bg-[hsl(var(--background))] text-white">
        <!-- GLOBAL ATMOSPHERE -->
        <div class="fixed inset-0 z-0 pointer-events-none">
            <!-- Retro Grid -->
            <div class="absolute inset-0 bg-grid opacity-20 transform perspective-1000 rotate-x-12 scale-150"></div>
            
            <!-- Vignette -->
            <div class="absolute inset-0 bg-radial-gradient from-transparent via-black/50 to-black"></div>
            
            <!-- Floating Spores (Upside Down Particles) -->
            <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-white/20 rounded-full blur-[1px] animate-float opacity-50"></div>
            <div class="absolute top-3/4 left-2/3 w-3 h-3 bg-red-500/10 rounded-full blur-[2px] animate-float opacity-30" style="animation-duration: 8s; animation-delay: 1s;"></div>
            <div class="absolute top-1/3 left-2/3 w-1 h-1 bg-white/10 rounded-full blur-[1px] animate-float opacity-40" style="animation-duration: 12s; animation-delay: 2s;"></div>
            <div class="absolute bottom-1/4 left-1/3 w-4 h-4 bg-red-900/10 rounded-full blur-[4px] animate-float opacity-20" style="animation-duration: 15s; animation-delay: 3s;"></div>
        </div>

        <!-- GLOBAL NAVBAR -->
        <header class="fixed top-0 w-full z-50 bg-background/80 backdrop-blur-md border-b border-white/5 h-16 flex items-center px-4 md:px-6">
            <div class="max-w-7xl mx-auto w-full flex justify-between items-center">
                <!--LEFT: LOGO-->
                <a href="/" class="font-serif text-[hsl(var(--primary))] text-xl md:text-2xl font-black tracking-tighter hover:scale-105 transition-transform">
                    STARCOURT<span class="text-white">CINEMA</span>
                </a>

                <!--RIGHT: NAV-->
                <div class="flex gap-4 md:gap-6 text-[10px] md:text-sm font-mono text-zinc-400 items-center">
                    <a href="{{ route('admin.movies') }}" class="hover:text-[hsl(var(--primary))] transition-colors">MOVIES_ADMIN</a>
                    <a href="{{ route('admin.users') }}" class="hover:text-[hsl(var(--primary))] transition-colors">USERS_ADMIN</a>
                    <a href="{{ route('admin.bookings') }}" class="hover:text-[hsl(var(--primary))] transition-colors">BOOKINGS_ADMIN</a>
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-[hsl(var(--primary))] transition-colors">DASHBOARD</a>
                        <span class="text-zinc-700">|</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="hover:text-red-500 transition-colors uppercase">
                                LOGOUT
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hover:text-[hsl(var(--primary))] transition-colors text-red-500/50" title="Verification Required: Please Login">DASHBOARD (UNVERIFIED)</a>
                    @endauth
                </div>
            </div>
        </header>

        <div class="relative z-10 min-h-screen flex flex-col {{ Request::is('login') || Request::is('register') ? 'pt-16' : 'pt-32' }}">
            @yield('content')
        </div>

        @stack('modals')
    </body>
</html>
