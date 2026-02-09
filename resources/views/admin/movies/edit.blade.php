@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto px-4 md:px-6 mb-12">
        <div class="mb-8 border-b border-white/10 pb-6">
            <p class="text-xs font-mono text-[hsl(var(--primary))] uppercase tracking-[0.3em] mb-2">Admin_Management</p>
            <h1 class="text-4xl md:text-5xl font-serif font-black text-white tracking-tight italic">
                EDIT_MOVIE
            </h1>
        </div>

        <div class="glass-panel rounded-lg p-8">
            <form action="{{ route('admin.movies.update', $movie->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <!-- Title -->
                    <div>
                        <label class="text-zinc-400 font-mono text-sm uppercase mb-2 block">Movie Title *</label>
                        <input type="text" name="title" value="{{ old('title', $movie->title) }}" required
                               class="w-full bg-black border border-zinc-700 rounded px-4 py-3 text-white font-mono focus:outline-none focus:border-red-500 transition-colors @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="text-red-500 text-xs font-mono mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rating & Duration -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-zinc-400 font-mono text-sm uppercase mb-2 block">Rating *</label>
                            <input type="text" name="rating" value="{{ old('rating', $movie->rating) }}" placeholder="e.g., PG-13, R, PG" required
                                   class="w-full bg-black border border-zinc-700 rounded px-4 py-3 text-white font-mono focus:outline-none focus:border-red-500 transition-colors @error('rating') border-red-500 @enderror">
                            @error('rating')
                                <p class="text-red-500 text-xs font-mono mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="text-zinc-400 font-mono text-sm uppercase mb-2 block">Duration *</label>
                            <input type="text" name="duration" value="{{ old('duration', $movie->duration) }}" placeholder="e.g., 115 MIN" required
                                   class="w-full bg-black border border-zinc-700 rounded px-4 py-3 text-white font-mono focus:outline-none focus:border-red-500 transition-colors @error('duration') border-red-500 @enderror">
                            @error('duration')
                                <p class="text-red-500 text-xs font-mono mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Price & Stars -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-zinc-400 font-mono text-sm uppercase mb-2 block">Price (Rp) *</label>
                            <input type="number" name="price" value="{{ old('price', $movie->price) }}" min="0" required
                                   class="w-full bg-black border border-zinc-700 rounded px-4 py-3 text-white font-mono focus:outline-none focus:border-red-500 transition-colors @error('price') border-red-500 @enderror">
                            @error('price')
                                <p class="text-red-500 text-xs font-mono mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="text-zinc-400 font-mono text-sm uppercase mb-2 block">Stars (1-5) *</label>
                            <input type="number" name="stars" value="{{ old('stars', $movie->stars) }}" min="1" max="5" required
                                   class="w-full bg-black border border-zinc-700 rounded px-4 py-3 text-white font-mono focus:outline-none focus:border-red-500 transition-colors @error('stars') border-red-500 @enderror">
                            @error('stars')
                                <p class="text-red-500 text-xs font-mono mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="text-zinc-400 font-mono text-sm uppercase mb-2 block">Description *</label>
                        <textarea name="description" rows="4" required
                                  class="w-full bg-black border border-zinc-700 rounded px-4 py-3 text-white font-mono focus:outline-none focus:border-red-500 transition-colors @error('description') border-red-500 @enderror">{{ old('description', $movie->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs font-mono mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Showtimes -->
                    <div>
                        <label class="text-zinc-400 font-mono text-sm uppercase mb-2 block">Showtimes (comma-separated) *</label>
                        <input type="text" name="showtimes" value="{{ old('showtimes', is_array($movie->showtimes) ? implode(', ', $movie->showtimes) : $movie->showtimes) }}" placeholder="e.g., 10:00, 13:00, 16:00, 19:00" required
                               class="w-full bg-black border border-zinc-700 rounded px-4 py-3 text-white font-mono focus:outline-none focus:border-red-500 transition-colors @error('showtimes') border-red-500 @enderror">
                        <p class="text-zinc-600 text-xs font-mono mt-1">Separate times with commas</p>
                        @error('showtimes')
                            <p class="text-red-500 text-xs font-mono mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image Path -->
                    <div>
                        <label class="text-zinc-400 font-mono text-sm uppercase mb-2 block">Image Path (optional)</label>
                        <input type="text" name="image" value="{{ old('image', $movie->image) }}" placeholder="e.g., images/season1.webp"
                               class="w-full bg-black border border-zinc-700 rounded px-4 py-3 text-white font-mono focus:outline-none focus:border-red-500 transition-colors @error('image') border-red-500 @enderror">
                        <p class="text-zinc-600 text-xs font-mono mt-1">Relative path to poster image</p>
                        @error('image')
                            <p class="text-red-500 text-xs font-mono mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Trailer -->
                    <div>
                        <label class="text-zinc-400 font-mono text-sm uppercase mb-2 block">Trailer (YouTube ID, optional)</label>
                        <input type="text" name="trailer" value="{{ old('trailer', $movie->trailer) }}" placeholder="e.g., dQw4w9WgXcQ"
                               class="w-full bg-black border border-zinc-700 rounded px-4 py-3 text-white font-mono focus:outline-none focus:border-red-500 transition-colors @error('trailer') border-red-500 @enderror">
                        <p class="text-zinc-600 text-xs font-mono mt-1">YouTube video ID only</p>
                        @error('trailer')
                            <p class="text-red-500 text-xs font-mono mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 mt-8 pt-6 border-t border-white/10">
                    <a href="{{ route('admin.movies') }}" class="flex-1 px-6 py-3 bg-zinc-800 hover:bg-zinc-700 text-zinc-400 hover:text-white border border-zinc-700 rounded font-mono text-sm uppercase text-center transition-all">
                        Cancel
                    </a>
                    <button type="submit" class="flex-1 px-6 py-3 bg-red-600 hover:bg-red-700 text-white rounded font-mono text-sm uppercase transition-all shadow-lg">
                        Update Movie
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
