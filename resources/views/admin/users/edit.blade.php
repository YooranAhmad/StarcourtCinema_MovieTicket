@extends('layouts.admin')

@section('content')
    <div class="max-w-4xl mx-auto px-4 md:px-6 mb-12">
        <div class="mb-8 border-b border-white/10 pb-6">
            <p class="text-xs font-mono text-[hsl(var(--primary))] uppercase tracking-[0.3em] mb-2">Admin_Management</p>
            <h1 class="text-4xl md:text-5xl font-serif font-black text-white tracking-tight italic">
                EDIT_USER
            </h1>
        </div>

        <div class="glass-panel rounded-lg p-8">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="space-y-6">
                    <!-- Name -->
                    <div>
                        <label class="text-zinc-400 font-mono text-sm uppercase mb-2 block">Name *</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                               class="w-full bg-black border border-zinc-700 rounded px-4 py-3 text-white font-mono focus:outline-none focus:border-blue-500 transition-colors @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-xs font-mono mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="text-zinc-400 font-mono text-sm uppercase mb-2 block">Email *</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                               class="w-full bg-black border border-zinc-700 rounded px-4 py-3 text-white font-mono focus:outline-none focus:border-blue-500 transition-colors @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="text-red-500 text-xs font-mono mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="text-zinc-400 font-mono text-sm uppercase mb-2 block">New Password (Optional)</label>
                            <input type="password" name="password"
                                   class="w-full bg-black border border-zinc-700 rounded px-4 py-3 text-white font-mono focus:outline-none focus:border-blue-500 transition-colors @error('password') border-red-500 @enderror">
                            <p class="text-zinc-600 text-xs font-mono mt-1">Leave blank to keep current password</p>
                            @error('password')
                                <p class="text-red-500 text-xs font-mono mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="text-zinc-400 font-mono text-sm uppercase mb-2 block">Confirm New Password</label>
                            <input type="password" name="password_confirmation"
                                   class="w-full bg-black border border-zinc-700 rounded px-4 py-3 text-white font-mono focus:outline-none focus:border-blue-500 transition-colors">
                        </div>
                    </div>

                    <!-- Role -->
                    <div class="flex items-center gap-3 p-4 border border-zinc-800 rounded bg-zinc-900/50">
                        <input type="checkbox" name="is_admin" id="is_admin" value="1" {{ old('is_admin', $user->is_admin) ? 'checked' : '' }}
                               class="w-5 h-5 bg-black border-zinc-600 rounded text-blue-600 focus:ring-blue-500 focus:ring-offset-black">
                        <label for="is_admin" class="text-white font-mono text-sm cursor-pointer">
                            Grant Administrator Privileges
                        </label>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 mt-8 pt-6 border-t border-white/10">
                    <a href="{{ route('admin.users') }}" class="flex-1 px-6 py-3 bg-zinc-800 hover:bg-zinc-700 text-zinc-400 hover:text-white border border-zinc-700 rounded font-mono text-sm uppercase text-center transition-all">
                        Cancel
                    </a>
                    <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded font-mono text-sm uppercase transition-all shadow-lg">
                        Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
