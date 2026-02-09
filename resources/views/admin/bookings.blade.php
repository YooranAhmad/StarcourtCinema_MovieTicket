@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto px-4 md:px-6 mb-12">
        <div class="mb-8 border-b border-white/10 pb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <p class="text-xs font-mono text-[hsl(var(--primary))] uppercase tracking-[0.3em] mb-2">Admin_Management</p>
                <h1 class="text-4xl md:text-6xl font-serif font-black text-white tracking-tight italic">
                    BOOKINGS_CONTROL
                </h1>
            </div>
            <div class="w-full md:w-auto">
                <form action="{{ route('admin.bookings') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search bookings..." 
                           class="bg-black/50 border border-zinc-700 rounded-lg px-4 py-2 pl-10 text-sm font-mono text-white focus:outline-none focus:border-[hsl(var(--primary))] transition-colors w-full sm:w-64">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="absolute left-3 top-1/2 -translate-y-1/2 text-zinc-500">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-500/20 border border-green-500 rounded-lg text-green-500 font-mono text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Statistics Summary -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="glass-panel rounded-lg p-6 border-l-4 border-l-green-500">
                <p class="text-green-500 font-mono text-xs tracking-widest uppercase mb-2">Paid Bookings</p>
                <h3 class="text-3xl font-bold text-white font-mono">{{ $bookings->where('payment_status', 'completed')->count() }}</h3>
            </div>
            <div class="glass-panel rounded-lg p-6 border-l-4 border-l-yellow-500">
                <p class="text-yellow-500 font-mono text-xs tracking-widest uppercase mb-2">Pending Payments</p>
                <h3 class="text-3xl font-bold text-white font-mono">{{ $bookings->where('payment_status', 'pending')->count() }}</h3>
            </div>
            <div class="glass-panel rounded-lg p-6 border-l-4 border-l-red-500">
                <p class="text-red-500 font-mono text-xs tracking-widest uppercase mb-2">Total Revenue</p>
                <h3 class="text-2xl font-bold text-white font-mono">Rp {{ number_format($bookings->where('payment_status', 'completed')->sum('total_price'), 0, ',', '.') }}</h3>
            </div>
        </div>

        <!-- Bookings Table -->
        <div class="glass-panel rounded-lg p-6">
            <div class="flex items-center gap-3 mb-6 border-b border-white/10 pb-4">
                <div class="w-2 h-2 bg-[hsl(var(--primary))] rounded-full animate-pulse"></div>
                <h2 class="text-xl font-serif text-white tracking-wide uppercase">All Bookings</h2>
                <span class="ml-auto text-sm font-mono text-zinc-500">{{ $bookings->count() }} result(s)</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm font-mono">
                    <thead>
                        <tr class="border-b border-white/10 text-zinc-500 text-xs uppercase tracking-wider">
                            <th class="text-left py-3 px-2">Code</th>
                            <th class="text-left py-3 px-2">Customer</th>
                            <th class="text-left py-3 px-2">Movie</th>
                            <th class="text-left py-3 px-2">Showtime</th>
                            <th class="text-left py-3 px-2">Seats</th>
                            <th class="text-center py-3 px-2">Qty</th>
                            <th class="text-right py-3 px-2">Amount</th>
                            <th class="text-center py-3 px-2">Status</th>
                            <th class="text-center py-3 px-2">Date</th>
                            <th class="text-right py-3 px-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings->sortByDesc('created_at') as $booking)
                        <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                            <td class="py-3 px-2 text-[hsl(var(--primary))] font-bold">{{ $booking->booking_code }}</td>
                            <td class="py-3 px-2 text-white">
                                <div>{{ $booking->name }}</div>
                                <div class="text-xs text-zinc-500">{{ $booking->email }}</div>
                            </td>
                            <td class="py-3 px-2 text-zinc-400">{{ $booking->title }}</td>
                            <td class="py-3 px-2 text-zinc-400">{{ $booking->showtime }}</td>
                            <td class="py-3 px-2 text-zinc-400 text-xs">{{ Str::limit($booking->seat, 20) }}</td>
                            <td class="py-3 px-2 text-center text-white">{{ $booking->quantity }}</td>
                            <td class="py-3 px-2 text-right text-green-500 font-bold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                            <td class="py-3 px-2 text-center">
                                @if($booking->payment_status === 'completed')
                                    <span class="px-2 py-1 bg-green-500/20 text-green-500 text-xs rounded border border-green-500/30 uppercase">Paid</span>
                                @else
                                    <span class="px-2 py-1 bg-yellow-500/20 text-yellow-500 text-xs rounded border border-yellow-500/30 uppercase">Pending</span>
                                @endif
                            </td>
                            <td class="py-3 px-2 text-center text-zinc-500 text-xs">{{ $booking->created_at->format('M d, Y H:i') }}</td>
                            <td class="py-3 px-2 text-right">
                                <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-white transition-colors" title="Delete Booking">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-8 text-zinc-600">
                                NO_BOOKINGS_FOUND
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
