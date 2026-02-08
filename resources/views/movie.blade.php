@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-4 md:px-6 py-4">
        <!-- Back Button -->
        <a href="/" class="inline-flex items-center gap-2 text-sm font-mono text-zinc-400 hover:text-[hsl(var(--primary))] transition-colors mb-8 group">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-arrow-left w-4 h-4 group-hover:-translate-x-1 transition-transform">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            BACK_TO_ARCHIVES
        </a>
        
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
            <!-- LEFT COLUMN: POSTER & STATS -->
            <div class="lg:col-span-4 space-y-6">
                <div class="relative group">
                    <div class="absolute -inset-1 bg-gradient-to-r from-red-600 to-red-900 rounded-xl blur opacity-25 group-hover:opacity-75 transition duration-1000 group-hover:duration-200"></div>
                    <img src="{{ asset($movie['image']) }}" alt="{{ $movie['title'] }}" class="relative w-full rounded-xl shadow-2xl border border-white/10 aspect-[2/3] object-cover">
                </div>

                <!-- Digital Stats Card -->
                <div class="relative bg-zinc-900/70 border border-red-900/30 rounded-lg p-4 backdrop-blur-sm shadow-xl overflow-hidden">
                    <!-- Scanline Effect -->
                    <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(rgba(18,16,16,0)_50%,rgba(0,0,0,0.15)_50%),linear-gradient(90deg,rgba(255,0,0,0.03),rgba(0,255,0,0.01),rgba(0,0,255,0.03))] z-0 bg-[length:100%_2px,3px_100%] opacity-30"></div>
                    
                    <!-- Content -->
                    <div class="relative z-10">
                        <div class="text-[10px] uppercase font-mono text-red-500/70 mb-3 tracking-widest flex items-center gap-2">
                            <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse"></span>
                            SYSTEM_DATA
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <span class="text-[10px] uppercase font-mono text-zinc-600">Rating</span>
                                <div class="text-white font-mono text-sm">{{ $movie['rating'] }}</div>
                            </div>
                            <div class="space-y-1">
                                <span class="text-[10px] uppercase font-mono text-zinc-600">Duration</span>
                                <div class="text-white font-mono text-sm flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-red-500"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                    {{ $movie['duration'] }}
                                </div>
                            </div>
                             <div class="space-y-1">
                                <span class="text-[10px] uppercase font-mono text-zinc-600">Price</span>
                                <div class="text-[hsl(var(--primary))] font-mono font-bold text-sm">Rp {{ number_format($movie['price'], 0, ',', '.') }}</div>
                            </div>
                             <div class="space-y-1">
                                <span class="text-[10px] uppercase font-mono text-zinc-600">User Score</span>
                                <div class="flex items-center gap-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-3 h-3 {{ $i <= $movie['stars'] ? 'text-yellow-500 fill-yellow-500' : 'text-zinc-800 fill-zinc-800' }}" fill="currentColor">
                                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: DETAILS & BOOKING -->
            <div class="lg:col-span-8 flex flex-col h-full">
                <!-- Glitch Title -->
                <h1 class="relative inline-block group text-4xl md:text-5xl lg:text-6xl font-serif font-black mb-6 leading-tight">
                    <!-- MAIN TEXT -->
                    <span class="relative z-10 text-transparent bg-clip-text bg-gradient-to-b from-red-600 to-red-900">
                        {{ $movie['title'] }}
                    </span>

                    <!-- RED GLITCH LAYER -->
                    <span class="absolute inset-0 -z-10 text-red-600 opacity-40 translate-x-[0.5px] -translate-y-[0.5px] mix-blend-screen">
                        {{ $movie['title'] }}
                    </span>

                    <!-- CYAN GLITCH LAYER -->
                    <span class="absolute inset-0 -z-10 text-cyan-400 opacity-40 -translate-x-[0.5px] translate-y-[0.5px] mix-blend-screen">
                        {{ $movie['title'] }}
                    </span>
                    <div class="scanline absolute inset-0 pointer-events-none"></div>
                </h1>

                <div class="prose prose-invert max-w-none mb-8">
                    <p class="text-zinc-300 text-lg leading-relaxed font-sans border-l-4 border-red-900/50 pl-6">
                        {{ $movie['description'] }}
                    </p>
                </div>

                <div class="flex-grow"></div> <!-- Spacer -->

                <!-- Trailer Button -->
                <button onclick="openTrailer()" class="group flex items-center gap-3 text-zinc-400 hover:text-white transition-colors mb-8 cursor-pointer w-fit">
                    <div class="w-10 h-10 rounded-full bg-white/5 border border-white/10 flex items-center justify-center group-hover:bg-red-600 group-hover:border-red-600 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="fill-current"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                    </div>
                    <span class="font-mono text-sm uppercase tracking-widest text-[10px]">Watch Trailer</span>
                </button>

                <!-- Booking Section -->
                <div class="relative bg-zinc-900/60 border border-red-900/30 rounded-xl p-6 lg:p-8 backdrop-blur-md shadow-2xl overflow-hidden">
                    <!-- Scanline Effect -->
                    <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(rgba(18,16,16,0)_50%,rgba(0,0,0,0.15)_50%),linear-gradient(90deg,rgba(255,0,0,0.03),rgba(0,255,0,0.01),rgba(0,0,255,0.03))] z-0 bg-[length:100%_2px,3px_100%] opacity-20"></div>
                    
                    <h3 class="relative z-10 text-xl font-mono text-white mb-6 flex items-center gap-2 uppercase tracking-wider">
                        <span class="w-2 h-2 bg-[hsl(var(--primary))] rounded-full animate-pulse"></span>
                        > TRANSMISSION_SCHEDULE
                    </h3>
                    
                    @auth
                        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-3 mb-8">
                             @foreach ($movie['showtimes'] as $showtime)
                                <div onclick="selectShowtime('{{ $showtime }}', this)"
                                     class="showtime-box relative overflow-hidden bg-black border border-zinc-700 py-3 px-2 text-center rounded text-zinc-300 font-mono text-sm cursor-pointer hover:border-white/30 transition-all select-none group">
                                     <span class="relative z-10">{{ $showtime }}</span>
                                     <div class="absolute inset-0 bg-red-900/20 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="text-center">
                             <input type="hidden" name="showtime" id="selectedShowtimeInput">
                             <button id="bookTicketBtn"
                                     onclick="openBookingModal()"
                                     class="w-full md:w-auto md:min-w-[300px] bg-zinc-800 text-zinc-500 font-bold py-4 px-8 rounded-lg uppercase tracking-widest transition-all cursor-not-allowed border border-white/5"
                                     disabled>
                                Select a Showtime
                             </button>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-zinc-400 font-mono mb-6">Authentication required to access booking mainframe.</p>
                            <a href="{{ route('login') }}" class="inline-block bg-red-700 hover:bg-red-600 text-white font-bold py-3 px-8 rounded pointer-events-auto uppercase tracking-widest shadow-lg transition-colors">
                                Login to Book
                            </a>
                             <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-3 mt-8 opacity-50 pointer-events-none grayscale">
                                 @foreach ($movie['showtimes'] as $showtime)
                                    <div class="bg-zinc-900 border border-zinc-700 py-3 px-2 text-center rounded text-zinc-500 font-mono text-sm">
                                        {{ $showtime }}
                                    </div>
                                @endforeach
                             </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

@endsection

@push('modals')
    <!-- BOOKING MODAL -->
    @auth
    <div id="bookingModalOverlay" class="fixed inset-0 z-[100] hidden bg-black/90 backdrop-blur-md items-center justify-center p-2 sm:p-4">
        <div class="grid grid-cols-1 w-full max-w-lg bg-black border-2 border-green-500/50 rounded-lg p-4 md:p-8 shadow-[0_0_50px_rgba(34,197,94,0.2)] max-h-[85vh] overflow-y-auto relative font-mono">
            <!-- CRT Scanline Overlay -->
            <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(rgba(18,16,16,0)_50%,rgba(0,0,0,0.25)_50%),linear-gradient(90deg,rgba(255,0,0,0.06),rgba(0,255,0,0.02),rgba(0,0,255,0.06))] z-10 bg-[length:100%_2px,3px_100%] opacity-20"></div>
            
            <button onclick="closeBookingModal()" class="absolute top-2 right-2 text-green-500/70 hover:text-green-400 font-mono text-xs uppercase tracking-widest z-20 transition-colors bg-black/50 px-2 py-1 rounded border border-green-900/30">
                [X] ABORT
            </button>

            <h2 class="text-xl md:text-2xl font-bold mb-6 text-green-500 uppercase tracking-widest border-b border-green-900/50 pb-2">
                > INITIATE_BOOKING_SEQUENCE
            </h2>

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-900/50 border border-red-500 rounded text-red-200 text-xs font-mono">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('bookings.store') }}" method="POST" class="space-y-5 relative z-20">
                @csrf
                <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
                <input type="hidden" name="title" value="{{ $movie['title'] }}">
                <input type="hidden" id="pricePerTicket" value="{{ $movie['price'] }}">
                <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                <input type="hidden" name="email" value="{{ Auth::user()->email }}">

                <div>
                    <label class="text-[10px] uppercase text-green-700 mb-1 block">Selected Showtime</label>
                    <input type="text" id="showtimeDisplay" name="showtime" readonly
                           class="w-full bg-black border border-green-900/50 rounded px-3 py-2 text-green-400 font-mono cursor-not-allowed focus:outline-none">
                </div>

                <div>
                    <label class="text-[10px] uppercase text-green-700 mb-1 block">Seat Coordinates (Selected: <span id="seatCountText">0</span>)</label>
                    <div id="seatSelection" class="grid grid-cols-6 sm:grid-cols-8 gap-2 mt-2 p-2 border border-green-900/30 rounded bg-green-900/5">
                        @php
                            $rows = ['A', 'B', 'C', 'D', 'E'];
                            $cols = range(1, 8);
                        @endphp
                        @foreach($rows as $row)
                            @foreach($cols as $col)
                                @php $seatId = $row . $col; @endphp
                                <div onclick="toggleSeat('{{ $seatId }}')" id="seat-{{ $seatId }}"
                                     class="seat-item w-full aspect-square flex items-center justify-center border border-green-500/30 rounded text-[10px] cursor-pointer hover:bg-green-500/20 hover:border-green-400 transition-colors text-green-600/70 select-none">
                                    {{ $seatId }}
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                    <input type="hidden" name="seat" id="selectedSeatsInput" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="text-[10px] uppercase text-green-700 mb-1 block">Quantity</label>
                        <input id="quantity" type="number" name="quantity" min="1" value="0" readonly
                               class="w-full bg-black border border-green-900/50 rounded px-3 py-2 text-green-400 font-mono cursor-not-allowed focus:outline-none">
                    </div>
                    <div>
                        <label class="text-[10px] uppercase text-green-700 mb-1 block">Total Cost</label>
                        <input id="totalPrice" type="text" name="total_price" value="Rp 0" readonly
                               class="w-full bg-black border border-green-900/50 rounded px-3 py-2 text-green-400 font-bold font-mono cursor-not-allowed focus:outline-none">
                    </div>
                </div>

                <button type="submit"
                        class="w-full mt-2 py-4 bg-green-900/20 border border-green-500 text-green-500 font-bold rounded hover:bg-green-500 hover:text-black transition-all uppercase tracking-[0.2em] shadow-[0_0_15px_rgba(34,197,94,0.1)] hover:shadow-[0_0_25px_rgba(34,197,94,0.5)]">
                    > CONFIRM_TRANSACTION
                </button>
            </form>
        </div>
    </div>
    @endauth

    <!-- TRAILER MODAL -->
    <div id="trailerModal" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/95 backdrop-blur-xl p-4">
        <div class="relative w-full max-w-5xl bg-black rounded-lg overflow-hidden border border-white/20 shadow-2xl">
            <div class="flex justify-between items-center p-3 border-b border-white/10 bg-zinc-900">
                <span class="text-xs font-mono text-zinc-400 uppercase tracking-widest">Incoming Transmission</span>
                <button onclick="closeTrailer()" class="text-zinc-400 hover:text-white text-xs font-mono uppercase tracking-widest flex items-center gap-2">
                    Terminate Signal <span class="text-lg">×</span> 
                </button>
            </div>
            <div class="relative aspect-video bg-black">
                <iframe id="trailerIframe" src="" title="Movie Trailer" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen class="absolute inset-0 w-full h-full"></iframe>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
    <!-- SCRIPTS -->
    <script>
    let selectedShowtime = "{{ old('showtime') }}"; 
    let bookedSeatsArray = []; // Seats already booked by others
    let selectedSeatsArray = @json(old('seat') ? explode(', ', old('seat')) : []); // Seats currently selected by user

    document.addEventListener('DOMContentLoaded', () => {
        // Restore Showtime Selection
        if (selectedShowtime) {
            // Find the button with this showtime text
            const buttons = document.querySelectorAll('.showtime-box');
            buttons.forEach(btn => {
                if (btn.innerText.trim() === selectedShowtime) {
                    selectShowtime(selectedShowtime, btn);
                }
            });
        }

        // Re-open modal if there are errors
        @if ($errors->any())
            if (selectedShowtime) {
                openBookingModal();
                // Restore seats
                selectedSeatsArray.forEach(seat => {
                    // Logic handled in updateSeatUI, but we need to ensure bookedSeats are fetched too
                });
                // We call updateSeatUI inside openBookingModal, but better to ensure it reflects current state
                updateSeatUI();
            }
        @endif
    });

    function selectShowtime(showtime, el) {
        selectedShowtime = showtime;
        // document.getElementById('selectedShowtimeInput').value = showtime; // <--- ERROR WAS HERE (ID doesn't exist)
        
        // Update UI
        document.querySelectorAll('.showtime-box').forEach(box => {
            box.classList.remove('bg-red-900/40', 'border-red-500', 'text-white', 'shadow-[0_0_15px_rgba(220,38,38,0.4)]');
            box.classList.add('bg-black', 'border-zinc-700', 'text-zinc-300');
        });
        
        el.classList.remove('bg-black', 'border-zinc-700', 'text-zinc-300');
        el.classList.add('bg-red-900/40', 'border-red-500', 'text-white', 'shadow-[0_0_15px_rgba(220,38,38,0.4)]');
        
        const btn = document.getElementById('bookTicketBtn');
        btn.disabled = false;
        btn.textContent = '> INITIALIZE_BOOKING';
        btn.classList.remove('bg-zinc-800', 'text-zinc-500', 'cursor-not-allowed', 'border-white/5');
        btn.classList.add('bg-red-700', 'hover:bg-red-600', 'text-white', 'shadow-[0_0_20px_rgba(220,38,38,0.4)]', 'hover:shadow-[0_0_30px_rgba(220,38,38,0.6)]', 'border-transparent');
    }
    
    function openBookingModal() {
        if (!selectedShowtime) return;
        
        document.getElementById('showtimeDisplay').value = selectedShowtime;
        const modal = document.getElementById('bookingModalOverlay');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        // Reset selection for new booking attempt
        selectedSeatsArray = [];
        updateSeatUI();
        
        // Fetch booked seats
        fetchBookedSeats();
    }

    function closeBookingModal() {
        const modal = document.getElementById('bookingModalOverlay');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function toggleSeat(seatId) {
        // Check if seat is already booked (disabled)
        if (bookedSeatsArray.includes(seatId)) return;
        
        const index = selectedSeatsArray.indexOf(seatId);
        if (index === -1) {
            selectedSeatsArray.push(seatId);
        } else {
            selectedSeatsArray.splice(index, 1);
        }
        updateSeatUI();
    }

    function updateSeatUI() {
        // 1. Reset all available seats to default state
        document.querySelectorAll('.seat-item').forEach(el => {
            const id = el.innerText.trim();
            if (!bookedSeatsArray.includes(id)) {
                el.className = 'seat-item w-full aspect-square flex items-center justify-center border border-green-500/30 rounded text-[10px] cursor-pointer hover:bg-green-500/20 hover:border-green-400 transition-colors text-green-600/70 select-none';
            }
        });

        // 2. Highlight selected seats
        selectedSeatsArray.forEach(seat => {
            const el = document.getElementById(`seat-${seat}`);
            if (el) {
                el.className = 'seat-item w-full aspect-square flex items-center justify-center border border-green-400 bg-green-500 text-black font-bold rounded text-[10px] cursor-pointer shadow-[0_0_10px_rgba(34,197,94,0.5)]';
            }
        });

        // 3. Mark booked seats (handled in fetchBookedSeats mostly, but re-enforcing here if needed)
        bookedSeatsArray.forEach(seat => {
             const el = document.getElementById(`seat-${seat}`);
             if (el) {
                 el.className = 'seat-item w-full aspect-square flex items-center justify-center border border-red-500/50 bg-red-900/50 rounded text-[10px] text-red-500 cursor-not-allowed opacity-50';
             }
        });

        // Update Inputs
        document.getElementById('selectedSeatsInput').value = selectedSeatsArray.join(', ');
        document.getElementById('seatCountText').innerText = selectedSeatsArray.length;
        document.getElementById('quantity').value = selectedSeatsArray.length;
        
        const pricePerTicket = parseFloat(document.getElementById('pricePerTicket').value);
        const total = pricePerTicket * selectedSeatsArray.length;
        
        // Format to Rupiah
        const formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        });
        
        document.getElementById('totalPrice').value = formatter.format(total);
    }
    
    function fetchBookedSeats() {
        if (!selectedShowtime) return;
        
        fetch(`/booked-seats?title={{ urlencode($movie['title']) }}&showtime=${selectedShowtime}`)
            .then(res => res.json())
            .then(seats => {
                bookedSeatsArray = seats; // Store globally
                
                // Update UI to reflect booked seats
                document.querySelectorAll('.seat-item').forEach(el => {
                    const seatId = el.innerText.trim();
                     if (bookedSeatsArray.includes(seatId)) {
                        el.className = 'seat-item w-full aspect-square flex items-center justify-center border border-red-500/50 bg-red-900/50 rounded text-[10px] text-red-500 cursor-not-allowed opacity-50';
                     } else if (!selectedSeatsArray.includes(seatId)) {
                        // Reset if not selected and not booked
                        el.className = 'seat-item w-full aspect-square flex items-center justify-center border border-green-500/30 rounded text-[10px] cursor-pointer hover:bg-green-500/20 hover:border-green-400 transition-colors text-green-600/70 select-none';
                     }
                });
            });
    }

    function openTrailer() {
        const modal = document.getElementById('trailerModal');
        const iframe = document.getElementById('trailerIframe');
        iframe.src = "https://www.youtube.com/embed/{{ $movie['trailer'] }}?autoplay=1";
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeTrailer() {
        const modal = document.getElementById('trailerModal');
        const iframe = document.getElementById('trailerIframe');
        iframe.src = "";
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
    </script>
@endpush
