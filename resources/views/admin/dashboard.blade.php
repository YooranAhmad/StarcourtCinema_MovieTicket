@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto px-4 md:px-6 mb-12">
        <div class="mb-12 border-b border-white/10 pb-6">
            <p class="text-xs font-mono text-[hsl(var(--primary))] uppercase tracking-[0.3em] mb-2">Admin_Access</p>
            <h1 class="text-4xl md:text-6xl font-serif font-black text-white tracking-tight italic">
                ADMIN_DASHBOARD
            </h1>
        </div>
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Users Card -->
            <div class="glass-panel rounded-lg p-6 border-l-4 border-l-blue-500 relative overflow-hidden group hover:shadow-[0_0_20px_rgba(59,130,246,0.3)] transition-all">
                <div class="scanline absolute inset-0 pointer-events-none opacity-10"></div>
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-blue-500 font-mono text-xs tracking-widest uppercase mb-2">Total Users</p>
                        <h3 class="text-3xl font-bold text-white font-mono">{{ number_format($totalUsers) }}</h3>
                    </div>
                    <div class="bg-blue-500/20 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-blue-500">
                            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-zinc-500 text-xs font-mono">Registered accounts</p>
            </div>

            <!-- Total Bookings Card -->
            <div class="glass-panel rounded-lg p-6 border-l-4 border-l-green-500 relative overflow-hidden group hover:shadow-[0_0_20px_rgba(34,197,94,0.3)] transition-all">
                <div class="scanline absolute inset-0 pointer-events-none opacity-10"></div>
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-green-500 font-mono text-xs tracking-widest uppercase mb-2">Completed Bookings</p>
                        <h3 class="text-3xl font-bold text-white font-mono">{{ number_format($totalBookings) }}</h3>
                    </div>
                    <div class="bg-green-500/20 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-green-500">
                            <path d="M2 9a3 3 0 0 1 0 6v2a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-2a3 3 0 0 1 0-6V7a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2Z"></path>
                            <path d="M13 5v2"></path>
                            <path d="M13 17v2"></path>
                            <path d="M13 11v2"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-zinc-500 text-xs font-mono">All time confirmed tickets</p>
            </div>

            <!-- Pending Bookings Card -->
            <div class="glass-panel rounded-lg p-6 border-l-4 border-l-yellow-500 relative overflow-hidden group hover:shadow-[0_0_20px_rgba(234,179,8,0.3)] transition-all">
                <div class="scanline absolute inset-0 pointer-events-none opacity-10"></div>
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-yellow-500 font-mono text-xs tracking-widest uppercase mb-2">Pending Payments</p>
                        <h3 class="text-3xl font-bold text-white font-mono">{{ number_format($pendingBookings) }}</h3>
                    </div>
                    <div class="bg-yellow-500/20 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-yellow-500">
                            <circle cx="12" cy="12" r="10"></circle>
                            <polyline points="12 6 12 12 16 14"></polyline>
                        </svg>
                    </div>
                </div>
                <p class="text-zinc-500 text-xs font-mono">Awaiting payment completion</p>
            </div>

            <!-- Total Revenue Card -->
            <div class="glass-panel rounded-lg p-6 border-l-4 border-l-red-500 relative overflow-hidden group hover:shadow-[0_0_20px_rgba(220,38,38,0.3)] transition-all">
                <div class="scanline absolute inset-0 pointer-events-none opacity-10"></div>
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <p class="text-[hsl(var(--primary))] font-mono text-xs tracking-widest uppercase mb-2">Total Revenue</p>
                        <h3 class="text-2xl font-bold text-white font-mono">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-red-500/20 p-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-red-500">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                </div>
                <p class="text-zinc-500 text-xs font-mono">All time earnings</p>
            </div>
        </div>

        <!-- Today's Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="glass-panel rounded-lg p-6 border border-cyan-500/30">
                <div class="flex items-center gap-3 mb-4">
                    <div class="bg-cyan-500/20 p-2 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-cyan-500">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <h3 class="text-cyan-500 font-mono text-sm tracking-widest uppercase">Today's Bookings</h3>
                </div>
                <p class="text-4xl font-bold text-white font-mono mb-2">{{ number_format($todayBookings) }}</p>
                <p class="text-zinc-500 text-xs font-mono">Tickets sold today</p>
            </div>

            <div class="glass-panel rounded-lg p-6 border border-purple-500/30">
                <div class="flex items-center gap-3 mb-4">
                    <div class="bg-purple-500/20 p-2 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="text-purple-500">
                            <line x1="12" y1="1" x2="12" y2="23"></line>
                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                        </svg>
                    </div>
                    <h3 class="text-purple-500 font-mono text-sm tracking-widest uppercase">Today's Revenue</h3>
                </div>
                <p class="text-4xl font-bold text-white font-mono mb-2">Rp {{ number_format($todayRevenue, 0, ',', '.') }}</p>
                <p class="text-zinc-500 text-xs font-mono">Earnings today</p>
            </div>
        </div>

        <!-- Recent Bookings -->
        <div class="glass-panel rounded-lg p-6">
            <div class="flex items-center gap-3 mb-6 border-b border-white/10 pb-4">
                <div class="w-2 h-2 bg-[hsl(var(--primary))] rounded-full animate-pulse"></div>
                <h2 class="text-xl font-serif text-white tracking-wide uppercase">Recent Bookings</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm font-mono">
                    <thead>
                        <tr class="border-b border-white/10 text-zinc-500 text-xs uppercase tracking-wider">
                            <th class="text-left py-3 px-2">Booking Code</th>
                            <th class="text-left py-3 px-2">Movie</th>
                            <th class="text-left py-3 px-2">Customer</th>
                            <th class="text-left py-3 px-2">Seats</th>
                            <th class="text-right py-3 px-2">Amount</th>
                            <th class="text-center py-3 px-2">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentBookings as $booking)
                        <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                            <td class="py-3 px-2 text-[hsl(var(--primary))] font-bold">{{ $booking->booking_code }}</td>
                            <td class="py-3 px-2 text-white">{{ $booking->title }}</td>
                            <td class="py-3 px-2 text-zinc-400">{{ $booking->name }}</td>
                            <td class="py-3 px-2 text-zinc-400">{{ $booking->seat }}</td>
                            <td class="py-3 px-2 text-right text-green-500 font-bold">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                            <td class="py-3 px-2 text-center text-zinc-500 text-xs">{{ $booking->created_at->format('M d, Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-zinc-600">
                                NO_BOOKINGS_FOUND
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 text-center">
                <a href="{{ route('admin.bookings') }}" class="inline-block px-6 py-2 bg-red-600/20 border border-red-500 text-red-500 font-mono text-xs tracking-widest uppercase rounded hover:bg-red-600 hover:text-white transition-all">
                    View All Bookings →
                </a>
            </div>
        </div>
    </div>  
@endsection