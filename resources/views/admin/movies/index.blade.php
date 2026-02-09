@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto px-4 md:px-6 mb-12">
        <div class="mb-8 border-b border-white/10 pb-6 flex justify-between items-center">
            <div>
                <p class="text-xs font-mono text-[hsl(var(--primary))] uppercase tracking-[0.3em] mb-2">Admin_Management</p>
                <h1 class="text-4xl md:text-6xl font-serif font-black text-white tracking-tight italic">
                    MOVIES_CONTROL
                </h1>
            </div>
            <a href="{{ route('admin.movies.create') }}" class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-mono text-sm uppercase tracking-widest rounded transition-all shadow-lg">
                + Add Movie
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-500/20 border border-green-500 rounded-lg text-green-500 font-mono text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Movie Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($movies as $movie)
            <div class="glass-panel rounded-lg overflow-hidden border border-white/10 hover:border-red-500/50 transition-all group">
                <!-- Movie Poster -->
                <div class="relative aspect-[2/3] overflow-hidden bg-zinc-900">
                    @if($movie->image)
                        <img src="{{ asset($movie->image) }}" alt="{{ $movie->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-zinc-600">
                            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                <rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"></rect>
                                <line x1="7" y1="2" x2="7" y2="22"></line>
                                <line x1="17" y1="2" x2="17" y2="22"></line>
                                <line x1="2" y1="12" x2="22" y2="12"></line>
                                <line x1="2" y1="7" x2="7" y2="7"></line>
                                <line x1="2" y1="17" x2="7" y2="17"></line>
                                <line x1="17" y1="17" x2="22" y2="17"></line>
                                <line x1="17" y1="7" x2="22" y2="7"></line>
                            </svg>
                        </div>
                    @endif
                    <div class="absolute top-2 right-2 px-2 py-1 bg-black/80 text-white text-xs font-mono rounded border border-white/20">
                        {{ $movie->rating }}
                    </div>
                </div>

                <!-- Movie Details -->
                <div class="p-4">
                    <h3 class="text-white font-serif text-lg font-bold mb-2">{{ $movie->title }}</h3>
                    
                    <div class="space-y-2 text-xs font-mono mb-4">
                        <div class="flex justify-between text-zinc-400">
                            <span>Duration:</span>
                            <span class="text-white">{{ $movie->duration }}</span>
                        </div>
                        <div class="flex justify-between text-zinc-400">
                            <span>Price:</span>
                            <span class="text-green-500 font-bold">Rp {{ number_format($movie->price, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-zinc-400">
                            <span>Rating:</span>
                            <span class="text-yellow-500">{{ $movie->stars }}/5 ⭐</span>
                        </div>
                        <div class="pt-2 border-t border-white/10">
                            <p class="text-zinc-500 mb-1">Showtimes:</p>
                            <div class="flex flex-wrap gap-1">
                                @foreach($movie->showtimes as $time)
                                    <span class="px-2 py-0.5 bg-red-500/20 text-red-500 rounded text-[10px]">{{ $time }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-2">
                        <a href="{{ route('admin.movies.edit', $movie->id) }}" class="flex-1 px-3 py-2 bg-blue-600/20 hover:bg-blue-600 text-blue-500 hover:text-white border border-blue-500 rounded text-xs font-mono uppercase text-center transition-all">
                            Edit
                        </a>
                        <form action="{{ route('admin.movies.destroy', $movie->id) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to delete this movie?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full px-3 py-2 bg-red-600/20 hover:bg-red-600 text-red-500 hover:text-white border border-red-500 rounded text-xs font-mono uppercase transition-all">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-zinc-600 font-mono text-lg mb-4">NO_MOVIES_FOUND</p>
                <a href="{{ route('admin.movies.create') }}" class="inline-block px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-mono text-sm uppercase tracking-widest rounded transition-all">
                    + Add Your First Movie
                </a>
            </div>
            @endforelse
        </div>
    </div>
@endsection
