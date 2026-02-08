@extends('layouts.app')

@section('content')

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
                <div class="glass-panel rounded-lg p-8 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition-opacity">
                        <svg xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="text-red-600 animate-pulse"><path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"></path><path d="M13 5v2"></path><path d="M13 17v2"></path><path d="M13 11v2"></path></svg>
                    </div>
                    
                    <div class="absolute top-4 right-4 text-[10px] font-mono text-green-500/50 uppercase tracking-widest border border-green-500/20 px-2 py-0.5 rounded">
                        Sys_Ready
                    </div>

                    <h2 class="text-2xl md:text-3xl font-serif font-bold mb-4 text-white text-shadow-neon break-words">Welcome back, {{ Auth::user()->name }}</h2>
                    <p class="text-zinc-400 font-mono text-sm leading-relaxed mb-6 max-w-xl">
                        Your portal to Hawkins' finest cinema experiences. Manage your bookings, explore the void, and prepare for the next feature presentation.
                    </p>
                    <div class="flex gap-4">
                        <a href="/" class="group relative px-6 py-2 bg-red-600/20 border border-red-500 text-red-500 font-mono text-xs tracking-widest uppercase rounded hover:bg-red-600 hover:text-white transition-all duration-300 overflow-hidden">
                            <span class="relative z-10 group-hover:tracking-[0.2em] transition-all">BROWSE_MOVIES</span>
                            <div class="absolute inset-0 bg-red-600 transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300 z-0"></div>
                        </a>
                    </div>
                </div>

                <!-- Recent Activity or info -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="glass-panel rounded p-6 border-l-4 border-l-green-500">
                        <h3 class="text-green-500 font-mono text-xs tracking-widest uppercase mb-4">Account_Status</h3>
                        <div class="flex items-center gap-3">
                            <div class="h-2 w-2 bg-green-500 rounded-full animate-pulse-glow"></div>
                            <span class="text-white font-mono text-sm uppercase">Secure_Connection</span>
                        </div>
                    </div>
                    <div class="glass-panel rounded p-6 border-l-4 border-l-blue-500">
                        <h3 class="text-blue-500 font-mono text-xs tracking-widest uppercase mb-4">Location_Triangulation</h3>
                        <div class="flex items-center gap-3">
                            <div class="text-blue-400 font-mono text-sm uppercase italic">Hawkins_Indiana</div>
                            <div class="text-[10px] text-zinc-600 font-mono break-all">34.1808° N, 118.3089° W</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="space-y-6">
                <div class="bg-red-950/20 border border-red-900/50 rounded-lg p-6 relative overflow-hidden">
                    <div class="scanline absolute inset-0 pointer-events-none opacity-20"></div>
                    <div class="absolute top-2 right-2 animate-pulse w-2 h-2 bg-red-600 rounded-full shadow-[0_0_10px_red]"></div>
                    
                    <h3 class="text-red-500 font-mono text-xs tracking-widest uppercase mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"></path><path d="M12 9v4"></path><path d="M12 17h.01"></path></svg>
                        Threat_Level_Midnight
                    </h3>
                    <p class="text-red-400/80 text-sm font-serif italic mb-4 leading-relaxed">
                        "Something is coming. Something hungry for blood. A shadow grows on the wall behind you..."
                    </p>
                    <div class="h-px bg-red-900/50 w-full mb-4"></div>
                    <p class="text-red-500/50 text-[10px] font-mono uppercase tracking-tighter blink">
                        Stay vigilant. The Upside Down is close.
                    </p>
                </div>

                <div class="glass-panel rounded-lg p-6">
                    <h3 class="text-white font-serif text-lg mb-4 text-shadow-glow">Quick Access</h3>
                    <ul class="space-y-3 font-mono text-xs text-zinc-400">
                        <li><a href="{{ route('bookings.index') }}" class="hover:text-[hsl(var(--primary))] hover:pl-2 transition-all flex justify-between group"><span>MY_TICKETS</span> <span class="group-hover:text-red-500">→</span></a></li>
                        <li><a href="/" class="hover:text-[hsl(var(--primary))] hover:pl-2 transition-all flex justify-between group"><span>LATEST_SHOWS</span> <span class="group-hover:text-red-500">→</span></a></li>
                        <li><a href="#" class="hover:text-[hsl(var(--primary))] hover:pl-2 transition-all flex justify-between group"><span>PROFILE_SETTINGS</span> <span class="group-hover:text-red-500">→</span></a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="w-full text-left hover:text-red-500 hover:pl-2 transition-all flex justify-between group uppercase">
                                    <span>LOGOUT</span> <span class="group-hover:text-red-500">→</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
