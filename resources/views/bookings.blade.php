@extends('layouts.app')
@section('content')

    <div class="text-center">

        <h1 class="relative inline-block group
           text-4xl md:text-6xl lg:text-7xl
           font-black leading-none mb-6 mt-4 md:mt-0
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
            @if($pendingBookings->isNotEmpty())
            <div class="mb-8 p-4 border border-yellow-500/30 bg-yellow-900/10 rounded-lg">
                <div class="flex items-center gap-2 mb-4 text-yellow-500">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 animate-pulse"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                    <h2 class="text-xl font-semibold uppercase tracking-widest">Pending Payments</h2>
                </div>

                <div class="grid gap-4">
                    @foreach($pendingBookings as $booking)
                    <div class="flex flex-col md:flex-row justify-between items-center p-4 bg-black/50 border border-yellow-500/20 rounded relative overflow-hidden group">
                        
                        <!-- Progress Bar Background -->
                        <div class="absolute bottom-0 left-0 h-1 bg-yellow-600 transition-all duration-1000" id="progress-{{ $booking->id }}" style="width: 100%"></div>

                        <div class="z-10 text-center md:text-left mb-4 md:mb-0">
                            <h3 class="text-white font-bold text-lg uppercase">{{ $booking->title }}</h3>
                            <div class="text-xs font-mono text-zinc-400 mt-1 space-x-3">
                                <span>{{ $booking->showtime }}</span>
                                <span>|</span>
                                <span>Seats: {{ $booking->seat }}</span>
                            </div>
                        </div>

                        <div class="z-10 flex items-center gap-4">
                            <div class="text-right">
                                <div class="text-[10px] uppercase text-zinc-500 font-mono">Expires In</div>
                                <div class="text-xl font-mono text-yellow-500 font-bold countdown-timer" 
                                     data-expire="{{ $booking->created_at->addMinutes(15)->timestamp * 1000 }}"
                                     data-id="{{ $booking->id }}">
                                    00:00
                                </div>
                            </div>
                            
                            <a href="{{ route('payment.show', $booking->id) }}" class="px-6 py-2 bg-yellow-600 hover:bg-yellow-500 text-black font-bold uppercase tracking-wider rounded font-mono text-xs transition-colors shadow-[0_0_10px_rgba(234,179,8,0.3)]">
                                Pay Now
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="flex items-center gap-2 mb-4 text-[hsl(var(--primary))]">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ticket w-4 h-4">
                    <path d="M2 9v6a2 2 0 0 0 0 4h1a2 2 0 0 1 2 2v1h14v-1a2 2 0 0 1 2-2h1a2 2 0 0 0 0-4v-6a2 2 0 0 0 0-4h-1a2 2 0 0 1-2-2v-1H5v1a2 2 0 0 1-2 2H2a2 2 0 0 0 0 4Z"></path>
                    <line x1="7" x2="17" y1="15" y2="15"></line>
                    <line x1="7" x2="17" y1="9" y2="9"></line>
                </svg>
                <h2 class="text-white text-xl font-semibold uppercase">Active Reservations</h2>
            </div>
            
            @forelse($tickets as $ticket)
            <div class="relative group border border-white/10 rounded-lg p-4 md:p-6 mb-4 text-white/80 bg-zinc-900/80 backdrop-blur-sm overflow-hidden transition-all duration-300 hover:border-red-500/50 hover:shadow-[0_0_20px_rgba(220,38,38,0.2)]">
                <!-- Decorative Bar -->
                <div class="absolute top-0 left-0 w-1 h-full bg-gradient-to-b from-red-600 to-red-900"></div>
                
                <!-- Scanline -->
                <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(rgba(18,16,16,0)_50%,rgba(0,0,0,0.1)_50%),linear-gradient(90deg,rgba(255,0,0,0.03),rgba(0,255,0,0.01),rgba(0,0,255,0.03))] z-0 bg-[length:100%_2px,3px_100%] opacity-20"></div>

                <div class="relative z-10 flex flex-col md:flex-row md:justify-between md:items-center gap-4">
                    <div class="flex flex-col flex-1">
                        <!--LEFT-SIDE: BOOKING INFO-->
                        <div class="flex items-center gap-3 mb-2">
                            <span class="px-2 py-0.5 bg-red-900/40 border border-red-500/30 rounded text-[10px] text-red-400 font-mono tracking-wider uppercase">Admit One</span>
                            <h2 class="text-md md:text-lg font-bold text-white uppercase tracking-wide text-shadow-neon break-words">
                                {{ $ticket->title }}
                            </h2>
                        </div>
                        
                        <div class="flex flex-wrap gap-4 text-xs font-mono text-zinc-400">
                             <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-500"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                {{ $ticket->showtime }}
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-500"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                Seats: <span class="text-white break-all">{{ $ticket->seat }}</span> (x{{ $ticket->quantity }})
                            </div>
                        </div>

                        <div class="text-lg text-red-500 mt-3 font-mono font-bold tracking-tighter">
                            Rp {{ number_format($ticket->total_price, 0, ',', '.') }}
                        </div>
                    </div>
                    
                    <div class="flex flex-row md:flex-col items-center justify-between md:justify-center gap-4 md:gap-2 md:text-right border-t md:border-t-0 md:border-l border-white/10 pt-4 md:pt-0 md:pl-6 border-dashed">
                        <div class="space-y-1 text-right">
                            <div class="text-[10px] text-zinc-500 uppercase font-mono tracking-widest">
                                Reference Code
                            </div>
                            <div class="text-sm md:text-base text-white font-mono font-bold tracking-widest uppercase bg-black/50 px-2 py-1 rounded border border-white/5">
                                {{ $ticket->booking_code }}
                            </div>
                        </div>
                        
                        <!-- Barcode Simulation -->
                        <div class="h-8 w-24 bg-white/10 mt-2 hidden md:block" style="background-image: repeating-linear-gradient(90deg, transparent, transparent 2px, #fff 2px, #fff 4px);"></div>
                    </div>    
                </div>
            </div>
            @empty
            <div class="text-center py-12 text-zinc-500 font-mono">
                NO TICKETS FOUND
            </div>
            @endforelse
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const timers = document.querySelectorAll('.countdown-timer');
            
            setInterval(() => {
                const now = new Date().getTime();
                
                timers.forEach(timer => {
                    const expireTime = parseInt(timer.getAttribute('data-expire'));
                    const distance = expireTime - now;
                    
                    if (distance < 0) {
                        timer.innerHTML = "EXPIRED";
                        timer.classList.add('text-red-500');
                        // Optional: Hide Pay Button
                        // window.location.reload(); // Reload to clear it via controller (or handle gracefully)
                    } else {
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                        
                        timer.innerHTML = 
                            (minutes < 10 ? "0" + minutes : minutes) + ":" + 
                            (seconds < 10 ? "0" + seconds : seconds);
                            
                         // Update progress bar
                         const id = timer.getAttribute('data-id');
                         const bar = document.getElementById(`progress-${id}`);
                         if(bar) {
                             const totalDuration = 15 * 60 * 1000; // 15 mins in ms
                             const elapsed = totalDuration - distance;
                             const percentage = (distance / totalDuration) * 100;
                             bar.style.width = percentage + "%";
                         }
                    }
                });
            }, 1000);
        });
    </script>
@endsection
