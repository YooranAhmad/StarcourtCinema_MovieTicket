@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-black p-4 relative overflow-hidden">
    <!-- Background elements -->
    <div class="absolute inset-0 scanline opacity-20"></div>
    <div class="absolute top-0 left-0 w-full h-1 bg-red-600 shadow-[0_0_15px_rgba(220,38,38,0.8)] animate-pulse"></div>
    
    <div class="w-full max-w-md z-10">
        <div class="bg-zinc-900 border-2 border-red-900 p-8 shadow-[0_0_20px_rgba(153,27,27,0.4)] relative">
            <!-- CRT Flicker overlay -->
            <div class="absolute inset-0 crt-flicker pointer-events-none opacity-5"></div>
            
            <div class="text-center mb-8">
                <h1 class="text-4xl text-red-600 uppercase tracking-tighter text-shadow-neon italic mb-2">
                    Starcourt
                </h1>
                <p class="text-zinc-500 uppercase text-xs tracking-[0.2em] font-mono">
                    Member Access • Hawkins, IN
                </p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400 font-mono uppercase tracking-widest text-center">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-zinc-400 uppercase text-[10px] tracking-widest mb-1 ml-1">{{ __('Email Address') }}</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                        class="w-full bg-black border border-red-950 text-zinc-200 px-4 py-3 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-all font-mono text-sm">
                    @if ($errors->has('email'))
                        <p class="text-red-600 text-[10px] uppercase tracking-wider mt-1 ml-1">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="block text-zinc-400 uppercase text-[10px] tracking-widest mb-1 ml-1">{{ __('Password') }}</label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="w-full bg-black border border-red-950 text-zinc-200 px-4 py-3 focus:outline-none focus:border-red-600 focus:ring-1 focus:ring-red-600 transition-all font-mono text-sm">
                    @if ($errors->has('password'))
                        <p class="text-red-600 text-[10px] uppercase tracking-wider mt-1 ml-1">{{ $errors->first('password') }}</p>
                    @endif
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                        <input id="remember_me" type="checkbox" name="remember" 
                            class="rounded bg-black border-red-950 text-red-600 shadow-sm focus:ring-red-600 focus:ring-offset-zinc-900">
                        <span class="ms-2 text-[10px] text-zinc-500 uppercase tracking-widest group-hover:text-zinc-300 transition-colors">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex flex-col space-y-4 mt-6">
                    <button class="w-full bg-red-700 hover:bg-red-600 text-white uppercase font-bold py-3 transition-colors shadow-[4px_4px_0px_rgba(0,0,0,1)] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none tracking-widest" type="submit">
                        {{ __('Login') }}
                    </button>
                    
                    <a class="text-center text-zinc-500 text-[10px] uppercase tracking-wider hover:text-red-600 transition-colors" href="{{ route('register') }}">
                        {{ __('Not registered yet?') }}
                    </a>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-red-950/30 text-center">
                <p class="text-zinc-500 text-[10px] uppercase tracking-wider">
                    New to Hawkins? <a href="{{ route('register') }}" class="text-red-600 hover:text-red-400 underline decoration-red-900 underline-offset-4">Create ID Card</a>
                </p>
            </div>
        </div>
        
        <div class="mt-4 flex justify-between px-2">
            <div class="flex items-center space-x-2">
                <div class="w-2 h-2 rounded-full bg-red-600 animate-pulse"></div>
                <span class="text-[8px] text-zinc-600 uppercase font-mono">System Online</span>
            </div>
            <span class="text-[8px] text-zinc-600 uppercase font-mono">© 1985 Hawkins Lab</span>
        </div>
    </div>
</div>
@endsection
