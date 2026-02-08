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
            <a href="{{ route('bookings.index') }}" class="hover:text-[hsl(var(--primary))] transition-colors">
                MY_TICKETS
            </a>
            @auth
                <a href="{{ route('dashboard') }}" class="hover:text-[hsl(var(--primary))] transition-colors">
                    ID_CARD
                </a>
            @else
                <a href="{{ route('login') }}" class="hover:text-[hsl(var(--primary))] transition-colors text-red-500/50" title="Verification Required: Please Login">
                    ID_CARD (UNVERIFIED)
                </a>
            @endauth
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
        
        <div class="flex md:flex-cols-2 gap-12 justify-center items-center">
            <div class="space-y-8 md:gap-12">
                <img src="{{ asset($movie['image']) }}"
                class="w-sm h-auto rounded-xl shadow-2xl border border-white/10">

                <div class="border rounded-xl border-white/10 bg-white/3 p-4">
                    <div class="flex justify-between items-center mb-2 border-b border-white/10 pb-2">
                        <span class="text-zinc-400 text-md uppercase">Rating</span>
                        <span class="px-2 py-1 border border-white/20 rounded">{{ $movie['rating'] }}</span>
                    </div>
                    <div class="flex gap-2 justify-between items-center mb-2 border-b border-white/10 pb-2">
                        <span class="text-zinc-400 text-md uppercase">Duration</span>
                        <span class="flex items-center gap-1 px-2 py-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock w-3 h-3"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                            {{ $movie['duration'] }}
                        </span>
                    </div>
                    <div class="flex gap-2 justify-between items-center">
                        <span class="text-zinc-400 text-md uppercase">Price</span>
                        <span class="px-2 py-1 text-[hsl(var(--primary))]">{{ $movie['price'] }}</span>
                    </div>
                </div>
            </div>
            

            <div class="flex flex-col">
                <h1 class="text-7xl font-serif mb-4">
                    {{ $movie['title'] }}
                </h1>

                <div class="flex items-center gap-2 mb-4">       
                    @for ($i = 1; $i <= 5; $i++)
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            class="w-5 h-5 {{ $i <= $movie['stars'] ? 'text-yellow-500 fill-yellow-500' : 'text-zinc-600 fill-zinc-600' }}"
                            fill="currentColor">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                        </svg>
                    @endfor
                </div>
                
                <p class="border-l-4 border-[hsl(var(--primary))] pl-4 text-zinc-400 mb-2 leading-relaxed">
                    {{ $movie['description'] }}
                </p>

                <a href="#"
                onclick="openTrailer()"
                class="inline-flex items-center gap-2 mt-4 text-sm font-mono text-zinc-400 uppercase hover:text-[hsl(var(--primary))] transition">
                    ▶ Watch Trailer
                </a>

                <div class="border border-white/10 mt-4 p-8 rounded-xl backdrop-blur-md">
                    <div class="flex gap-2 items-center mb-2 pb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-calendar w-5 h-5 text-[hsl(var(--primary))]"><path d="M8 2v4"></path><path d="M16 2v4"></path><rect width="18" height="18" x="3" y="4" rx="2"></rect><path d="M3 10h18"></path></svg>
                        <span class="text-lg font-mono text-white font-bold uppercase">Available Showtimes</span>
                    </div>

                    @auth
                    <input type="hidden" name="showtime" id="selectedShowtimeInput">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-2">                   
                                @foreach ($movie['showtimes'] as $showtime)
                                    <div
                                        onclick="selectShowtime('{{ $showtime }}', this)"
                                        class="showtime-box bg-zinc-900 border border-zinc-700 p-3 text-center rounded text-white font-mono cursor-pointer transition-all duration-200">
                                        {{ $showtime }}
                                    </div>

                                @endforeach
                        </div>
                    @else
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                        @foreach ($movie['showtimes'] as $showtime)
                        <div
                        class="bg-zinc-900 border border-zinc-700 p-3 text-center rounded text-white font-mono hover:bg-[hsl(var(--primary))] hover:text-black hover:border-[hsl(var(--primary))] cursor-default transition-all duration-200">{{ $showtime }}
                        </div>
                        @endforeach
                    @endauth

                    @auth
                        <a href="#" onclick="openBookingModal()" class="mt-6 inline-block w-full text-center bg-[hsl(var(--primary))] hover:bg-white/5 hover:text-[hsl(var(--primary))] text-white font-bold py-3 rounded-lg uppercase tracking-wider transition-colors">
                        BOOK TICKET
                        </a>
                    @else
                        <a href="#" onclick="openLoginPrompt()" class="mt-6 inline-block w-full text-center bg-zinc-800 hover:bg-zinc-700 text-zinc-400 font-bold py-3 rounded-lg uppercase tracking-wider transition-colors border border-white/5 shadow-xl">
                        BOOK TICKET (LOGIN REQUIRED)
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </section>

    <!-- LOGIN PROMPT MODAL -->
    <div id="loginPromptOverlay"
         class="fixed inset-0 z-[1000] hidden bg-black/90 backdrop-blur-md items-center justify-center p-4">
        <div class="w-full max-w-sm bg-zinc-950 border-2 border-red-900 p-8 shadow-[0_0_30px_rgba(153,27,27,0.4)] relative">
            <div class="absolute inset-0 scanline opacity-10 pointer-events-none"></div>
            <button onclick="closeLoginPrompt()" class="absolute top-4 right-4 text-zinc-500 hover:text-white font-mono">✕</button>
            
            <div class="text-center mb-8">
                <h3 class="text-2xl text-red-600 font-serif uppercase tracking-tighter italic mb-2">Access Denied</h3>
                <p class="text-zinc-500 text-[10px] font-mono uppercase tracking-[0.2em]">Verification Required: Hawkins ID Required</p>
            </div>

            <p class="text-zinc-400 text-sm font-mono mb-8 text-center leading-relaxed">
                Booking systems are reserved for verified Starcourt members. Please present your credentials.
            </p>

            <div class="space-y-4">
                <a href="{{ route('login') }}" class="block w-full text-center bg-red-700 hover:bg-red-600 text-white font-bold py-3 uppercase tracking-widest shadow-[4px_4px_0px_rgba(0,0,0,1)] active:translate-x-[1px] active:translate-y-[1px] active:shadow-none transition-all">
                    Present Credentials
                </a>
                <a href="{{ route('register') }}" class="block w-full text-center border border-red-900/50 hover:border-red-600 text-zinc-500 hover:text-red-600 font-bold py-3 uppercase tracking-widest transition-all">
                    Apply for ID Card
                </a>
            </div>
        </div>
    </div>

    <!-- BOOKING MODAL -->
    @auth
    <div id="bookingModalOverlay"
         class="fixed inset-0 z-[999] hidden bg-black/80 backdrop-blur-sm items-center justify-center">

        <!-- PANEL -->
        <div class="grid grid-cols-1 w-full h-auto max-w-lg bg-zinc-950 border border-white/10 rounded-2xl p-8 shadow-2xl">

            <!-- CLOSE -->
            <button onclick="closeBookingModal()"
                    class="absolute top-4 right-4 text-zinc-400 hover:text-white font-mono text-sm">
                ✕ Close
            </button>

            <h2 class="text-2xl font-serif mb-6 text-[hsl(var(--primary))]">
                Book Ticket
            </h2>

            <form action="{{ route('bookings.store') }}" method="POST" class="space-y-4">
                @csrf

                <input type="hidden" name="movie_id" value="{{ $movie['id'] }}">
                <input type="hidden" name="title" value="{{ $movie['title'] }}">
                <input type="hidden" id="pricePerTicket" value="{{ str_replace('$','',$movie['price']) }}">

                <div>
                    <label class="text-xs text-zinc-400">Name</label>
                    <input name="name" value="{{ Auth::user()->name }}" required
                           class="w-full bg-black border border-white/10 rounded px-3 py-2 text-white">
                </div>

                <div>
                    <label class="text-xs text-zinc-400">Email</label>
                    <input type="email" name="email" value="{{ Auth::user()->email }}" required
                           class="w-full bg-black border border-white/10 rounded px-3 py-2 text-white">
                </div>

            <div>
                <label class="text-xs text-zinc-400">Showtime</label>
                <input type="text"
                    id="showtimeDisplay"
                    name="showtime"
                    readonly
                    class="w-full bg-black border border-white/10 rounded px-3 py-2 text-white cursor-not-allowed">
            </div>

            <div>
                <label class="text-xs text-zinc-400">Seats (Select <span id="seatCountText">1</span>)</label>
                <div id="seatSelection" class="grid grid-cols-8 gap-1 mt-2">
                    @php
                        $rows = ['A', 'B', 'C', 'D', 'E'];
                        $cols = range(1, 8);
                    @endphp
                    @foreach($rows as $row)
                        @foreach($cols as $col)
                            @php $seatId = $row . $col; @endphp
                            <div onclick="toggleSeat('{{ $seatId }}')" 
                                 id="seat-{{ $seatId }}"
                                 class="seat-item w-8 h-8 flex items-center justify-center border border-white/10 rounded text-[10px] cursor-pointer hover:bg-white/5 transition-colors text-zinc-400">
                                {{ $seatId }}
                            </div>
                        @endforeach
                    @endforeach
                </div>
                <input type="hidden" name="seat" id="selectedSeatsInput" required>
            </div>

            <div>
                <label class="text-xs text-zinc-400">Quantity</label>
                <input id="quantity" type="number" name="quantity" min="1" value="1"
                       class="w-full bg-black border border-white/10 rounded px-3 py-2 text-white">
            </div>

            <div>
                <label class="text-xs text-zinc-400">Total Price</label>
                <input id="totalPrice" type="text" name="total_price"
                       value="{{ $movie['price'] }}"
                       readonly
                       class="w-full bg-black border border-white/10 rounded px-3 py-2 cursor-not-allowed text-white">
            </div>

            <button type="submit"
                    class="w-full mt-4 py-3 bg-[hsl(var(--primary))] text-black font-bold rounded-lg hover:scale-[1.02] transition">
                CONFIRM BOOKING
            </button>
        </form>
        </div>
    </div>
    @endauth

    <!-- TRAILER MODAL -->
    <div id="trailerModal"
     class="fixed inset-0 z-[999] hidden items-center justify-center bg-black/80 backdrop-blur-sm">

    <!-- PANEL -->
    <div class="relative w-full max-w-4xl mx-4">
        
        <!-- CLOSE -->
        <button onclick="closeTrailer()"
                class="absolute -top-10 right-0 text-zinc-400 hover:text-white text-sm font-mono">
            ✕ Close
        </button>

        <!-- VIDEO -->
        <div class="relative aspect-video rounded-xl overflow-hidden border border-white/10 shadow-2xl bg-black">
                <iframe
                    id="trailerIframe"
                    src=""
                    title="Movie Trailer"
                    frameborder="0"
                    allow="autoplay; encrypted-media"
                    allowfullscreen
                    class="absolute inset-0 w-full h-full">
                </iframe>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->

    <script>
    let selectedShowtime = null;

    function openBookingModal() {
        if (!selectedShowtime) {
        alert('Please select a showtime first');
        return;
    }

        fetch(`/booked-seats?title={{ urlencode($movie['title']) }}&showtime=${selectedShowtime}`)
            .then(response => response.json())
            .then(bookedSeats => {

                resetSeats(); // clear previous state

                bookedSeats.forEach(seat => {
                    const el = document.getElementById(`seat-${seat}`);
                    if (el) {
                        el.classList.add('opacity-30', 'cursor-not-allowed');
                        el.onclick = null;
                    }
                });

                document.getElementById('selectedShowtimeInput').value = selectedShowtime;

                const modal = document.getElementById('bookingModalOverlay');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            });
    }

    function resetSeats() {
        selectedSeats = [];
        if (selectedSeatsInput) {
            selectedSeatsInput.value = '';
        }

        document.querySelectorAll('.seat-item').forEach(el => {
            el.className =
                'seat-item w-8 h-8 flex items-center justify-center border border-white/10 rounded text-[10px] cursor-pointer text-zinc-400 hover:bg-white/5';
            el.onclick = function () {
                toggleSeat(el.innerText);
            };

        });
    }

    function selectShowtime(showtime, el) {
        selectedShowtime = showtime;

        document.querySelectorAll('.showtime-box').forEach(box => {
            box.classList.remove('bg-[hsl(var(--primary))]', 'text-black');
        });

        el.classList.add('bg-[hsl(var(--primary))]', 'text-black');

        // 🔥 THIS WAS MISSING
        document.getElementById('selectedShowtimeInput').value = showtime;
        document.getElementById('showtimeDisplay').value = showtime;
    }





    function closeBookingModal() {
        const modal = document.getElementById('bookingModalOverlay');
        if (modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    }

    function openLoginPrompt() {
        const modal = document.getElementById('loginPromptOverlay');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeLoginPrompt() {
        const modal = document.getElementById('loginPromptOverlay');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    const qtyInput = document.getElementById('quantity');
    const totalInput = document.getElementById('totalPrice');
    const pricePerTicketEl = document.getElementById('pricePerTicket');
    const price = pricePerTicketEl ? parseFloat(pricePerTicketEl.value) : 0;
    const seatCountText = document.getElementById('seatCountText');
    const selectedSeatsInput = document.getElementById('selectedSeatsInput');
    let selectedSeats = [];

    qtyInput.addEventListener('input', () => {
        const qty = Math.max(1, qtyInput.value);
        totalInput.value = `$${(price * qty).toFixed(2)}`;
        seatCountText.innerText = qty;
        
        // Clear selection if quantity decreases below selection count
        if (selectedSeats.length > qty) {
            selectedSeats = selectedSeats.slice(0, qty);
            updateSeatUI();
        }
    });

    function toggleSeat(seatId) {
        const qty = parseInt(qtyInput.value);
        const index = selectedSeats.indexOf(seatId);
        
        if (index > -1) {
            selectedSeats.splice(index, 1);
        } else {
            if (selectedSeats.length < qty) {
                selectedSeats.push(seatId);
            } else {
                // Replace the first selected seat if at capacity
                selectedSeats.shift();
                selectedSeats.push(seatId);
            }
        }
        updateSeatUI();
    }

    function updateSeatUI() {
        document.querySelectorAll('.seat-item').forEach(el => {
            el.classList.remove('bg-[hsl(var(--primary))]', 'text-black', 'border-[hsl(var(--primary))]');
            el.classList.add('text-zinc-400', 'border-white/10');
        });

        selectedSeats.forEach(seatId => {
            const el = document.getElementById(`seat-${seatId}`);
            if (el) {
                el.classList.add('bg-[hsl(var(--primary))]', 'text-black', 'border-[hsl(var(--primary))]');
                el.classList.remove('text-zinc-400', 'border-white/10');
            }
        });

        selectedSeatsInput.value = selectedSeats.join(', ');
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

        iframe.src = ""; // stop video
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
    </script>
</body>
@endsection
