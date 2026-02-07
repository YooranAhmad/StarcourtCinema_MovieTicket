@extends('layouts.app')

@section('content')
<header class="fixed top-0 w-full z-50 bg-background/80 backdrop-blur-md border-b border-white/5 h-16 flex items-center px-4 md:px-6">
    <div class="max-w-7xl mx-auto w-full flex justify-between items-center">
        <a href="/" class="font-serif text-[hsl(var(--primary))] text-xl md:text-2xl font-black tracking-tighter hover:scale-105 transition-transform">
            STARCOURT<span class="text-white">CINEMA</span>
        </a>

        <div class="flex gap-4 md:gap-6 text-[10px] md:text-sm font-mono text-zinc-400">
            <a href="/" class="hover:text-[hsl(var(--primary))] transition-colors">MOVIES</a>
            <a href="{{ route('bookings.index') }}" class="hover:text-[hsl(var(--primary))] transition-colors">MY_TICKETS</a>
            <a href="{{ route('dashboard') }}" class="text-[hsl(var(--primary))] transition-colors">ID_CARD</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="hover:text-[hsl(var(--primary))] transition-colors uppercase cursor-pointer">LOGOUT</button>
            </form>
        </div>
    </div>
</header>

<body class="bg-[hsl(var(--background))] text-white min-h-screen pt-24 pb-12">
    <div class="max-w-7xl mx-auto px-4 md:px-6">
        <div class="mb-12 border-b border-white/10 pb-6">
            <p class="text-xs font-mono text-[hsl(var(--primary))] uppercase tracking-[0.3em] mb-2">Authenticated_Access</p>
            <h1 class="text-4xl md:text-6xl font-serif font-black text-white tracking-tight italic">
                USER_DASHBOARD
            </h1>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Stats/Welcome Card -->
            <div class="md:col-span-2 space-y-8">
                <div class="bg-zinc-900/50 border border-white/5 rounded-lg p-8 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="text-red-600"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"></path><path d="M13 5v2"></path><path d="M13 17v2"></path><path d="M13 11v2"></path></svg>
                    </div>
                    <h2 class="text-2xl font-serif font-bold mb-4 text-white">Welcome back, {{ Auth::user()->name }}</h2>
                    <p class="text-zinc-400 font-mono text-sm leading-relaxed mb-6 max-w-xl">
                        Your portal to Hawkins' finest cinema experiences. Manage your bookings, explore the void, and prepare for the next feature presentation.
                    </p>
                    <div class="flex gap-4">
                        <a href="/" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded font-mono text-xs tracking-widest transition-colors">BROWSE_MOVIES</a>
                    </div>
                </div>

                <!-- Recent Activity or info -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="bg-zinc-900/30 border border-white/5 rounded p-6">
                        <h3 class="text-[hsl(var(--primary))] font-mono text-xs tracking-widest uppercase mb-4">Account_Status</h3>
                        <div class="flex items-center gap-3">
                            <div class="h-2 w-2 bg-green-500 rounded-full animate-pulse"></div>
                            <span class="text-white font-mono text-sm uppercase">Secure_Connection</span>
                        </div>
                    </div>
                    <div class="bg-zinc-900/30 border border-white/5 rounded p-6">
                        <h3 class="text-[hsl(var(--primary))] font-mono text-xs tracking-widest uppercase mb-4">Location</h3>
                        <div class="flex items-center gap-3">
                            <span class="text-white font-mono text-sm uppercase italic">Hawkins_Indiana</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="space-y-6">
                <div class="bg-red-950/20 border border-red-900/30 rounded-lg p-6 relative overflow-hidden">
                    <div class="scanline absolute inset-0 pointer-events-none opacity-20"></div>
                    <h3 class="text-red-500 font-mono text-xs tracking-widest uppercase mb-4">Warning</h3>
                    <p class="text-zinc-300 text-sm font-serif italic mb-4">
                        "Something is coming. Something hungry for blood. A shadow grows on the wall behind you..."
                    </p>
                    <div class="h-px bg-red-900/50 w-full mb-4"></div>
                    <p class="text-zinc-500 text-[10px] font-mono uppercase tracking-tighter">
                        Stay vigilant. The Upside Down is closer than you think.
                    </p>
                </div>

                <div class="bg-zinc-900/80 border border-white/5 rounded-lg p-6">
                    <h3 class="text-white font-serif text-lg mb-4">Quick Links</h3>
                    <ul class="space-y-3 font-mono text-xs text-zinc-400">
                        <li><a href="{{ route('bookings.index') }}" class="hover:text-[hsl(var(--primary))] transition-colors flex justify-between"><span>MY_TICKETS</span> <span>→</span></a></li>
                        <li><a href="/" class="hover:text-[hsl(var(--primary))] transition-colors flex justify-between"><span>LATEST_SHOWS</span> <span>→</span></a></li>
                        <li><a href="#" class="hover:text-[hsl(var(--primary))] transition-colors flex justify-between"><span>PROFILE_SETTINGS</span> <span>→</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
