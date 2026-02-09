@extends('layouts.admin')

@section('content')
    <div class="max-w-7xl mx-auto px-4 md:px-6 mb-12">
        <div class="mb-8 border-b border-white/10 pb-6 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <p class="text-xs font-mono text-[hsl(var(--primary))] uppercase tracking-[0.3em] mb-2">Admin_Management</p>
                <h1 class="text-4xl md:text-6xl font-serif font-black text-white tracking-tight italic">
                    USERS_CONTROL
                </h1>
            </div>
            <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                <form action="{{ route('admin.users') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users..." 
                           class="bg-black/50 border border-zinc-700 rounded-lg px-4 py-2 pl-10 text-sm font-mono text-white focus:outline-none focus:border-[hsl(var(--primary))] transition-colors w-full sm:w-64">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="absolute left-3 top-1/2 -translate-y-1/2 text-zinc-500">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </form>
                <a href="{{ route('admin.users.create') }}" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-mono text-xs uppercase tracking-widest rounded transition-all shadow-lg text-center flex items-center justify-center">
                    + Add User
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-green-500/20 border border-green-500 rounded-lg text-green-500 font-mono text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- Statistics Summary -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="glass-panel rounded-lg p-6 border-l-4 border-l-blue-500">
                <p class="text-blue-500 font-mono text-xs tracking-widest uppercase mb-2">Total Users</p>
                <h3 class="text-3xl font-bold text-white font-mono">{{ $users->count() }}</h3>
            </div>
            <div class="glass-panel rounded-lg p-6 border-l-4 border-l-purple-500">
                <p class="text-purple-500 font-mono text-xs tracking-widest uppercase mb-2">Admin Users</p>
                <h3 class="text-3xl font-bold text-white font-mono">{{ $users->where('is_admin', 1)->count() }}</h3>
            </div>
            <div class="glass-panel rounded-lg p-6 border-l-4 border-l-green-500">
                <p class="text-green-500 font-mono text-xs tracking-widest uppercase mb-2">Regular Users</p>
                <h3 class="text-3xl font-bold text-white font-mono">{{ $users->where('is_admin', 0)->count() }}</h3>
            </div>
        </div>

        <!-- Users Table -->
        <div class="glass-panel rounded-lg p-6">
            <div class="flex items-center gap-3 mb-6 border-b border-white/10 pb-4">
                <div class="w-2 h-2 bg-[hsl(var(--primary))] rounded-full animate-pulse"></div>
                <h2 class="text-xl font-serif text-white tracking-wide uppercase">All Users</h2>
                <span class="ml-auto text-sm font-mono text-zinc-500">{{ $users->count() }} result(s)</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm font-mono">
                    <thead>
                        <tr class="border-b border-white/10 text-zinc-500 text-xs uppercase tracking-wider">
                            <th class="text-left py-3 px-2">ID</th>
                            <th class="text-left py-3 px-2">Name</th>
                            <th class="text-left py-3 px-2">Email</th>
                            <th class="text-center py-3 px-2">Role</th>
                            <th class="text-center py-3 px-2">Joined</th>
                            <th class="text-right py-3 px-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users->sortByDesc('created_at') as $user)
                        <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                            <td class="py-3 px-2 text-[hsl(var(--primary))] font-bold">#{{ $user->id }}</td>
                            <td class="py-3 px-2 text-white">{{ $user->name }}</td>
                            <td class="py-3 px-2 text-zinc-400">{{ $user->email }}</td>
                            <td class="py-3 px-2 text-center">
                                @if($user->is_admin == 1)
                                    <span class="px-2 py-1 bg-red-500/20 text-red-500 text-xs rounded border border-red-500/30 uppercase font-bold">Admin</span>
                                @else
                                    <span class="px-2 py-1 bg-blue-500/20 text-blue-500 text-xs rounded border border-blue-500/30 uppercase">User</span>
                                @endif
                            </td>
                            <td class="py-3 px-2 text-center text-zinc-500 text-xs">{{ $user->created_at->format('M d, Y') }}</td>
                            <td class="py-3 px-2 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-500 hover:text-white transition-colors" title="Edit User">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-white transition-colors" title="Delete User">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-zinc-600">
                                NO_USERS_FOUND
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
