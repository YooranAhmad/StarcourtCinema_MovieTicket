@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 md:px-6 py-4">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="relative inline-block group
           text-4xl md:text-6xl lg:text-7xl
           font-black leading-none mb-6 mt-4 md:mt-0
           font-serif tracking-tight
           text-transparent bg-clip-text
           bg-gradient-to-b from-red-600 to-red-900
           text-shadow-glitch">
                <!-- MAIN TEXT -->
                <span class="relative z-10">
                    SECURE_PAYMENT
                </span>

                <!-- RED GLITCH LAYER -->
                <span class="absolute inset-0
                        -z-10
                        text-red-600 opacity-50
                        translate-x-[2px] -translate-y-[1px]
                        crt-flicker
                        mix-blend-screen">
                    SECURE_PAYMENT
                </span>

                <!-- CYAN GLITCH LAYER -->
                <span class="absolute inset-0
                        -z-10
                        text-cyan-400 opacity-50
                        -translate-x-[2px] translate-y-[1px]
                        crt-flicker
                        mix-blend-screen">
                    SECURE_PAYMENT
                </span>
                <div class="scanline absolute inset-0 pointer-events-none"></div>
            </h1>
            <p class="text-sm font-mono text-zinc-500 uppercase tracking-widest">Hawkins Lab Secure Transaction</p>
        </div>

        <!-- Booking Summary -->
        <div class="relative bg-zinc-900/70 border border-red-900/30 rounded-lg p-6 mb-6 backdrop-blur-sm shadow-xl overflow-hidden">
            <!-- Scanline Effect -->
            <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(rgba(18,16,16,0)_50%,rgba(0,0,0,0.15)_50%),linear-gradient(90deg,rgba(255,0,0,0.03),rgba(0,255,0,0.01),rgba(0,0,255,0.03))] z-0 bg-[length:100%_2px,3px_100%] opacity-30"></div>
            
            <div class="relative z-10">
                <div class="text-[10px] uppercase font-mono text-red-500/70 mb-4 tracking-widest flex items-center gap-2">
                    <span class="w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse"></span>
                    ORDER_SUMMARY
                </div>

                <div class="space-y-3">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-zinc-500 font-mono">Movie:</span>
                        <span class="text-white font-bold">{{ $booking->title }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-zinc-500 font-mono">Showtime:</span>
                        <span class="text-white">{{ $booking->showtime }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-zinc-500 font-mono">Seats:</span>
                        <span class="text-white">{{ $booking->seat }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-zinc-500 font-mono">Quantity:</span>
                        <span class="text-white">{{ $booking->quantity }}</span>
                    </div>
                    <div class="border-t border-red-900/30 pt-3 mt-3"></div>
                    <div class="flex justify-between items-center">
                        <span class="text-zinc-400 font-mono uppercase text-sm">Total Amount:</span>
                        <span class="text-[hsl(var(--primary))] font-mono font-bold text-2xl">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Action -->
        <div class="relative bg-black/60 border border-red-900/30 rounded-lg p-6 md:p-8 backdrop-blur-md shadow-2xl overflow-hidden">
            <!-- Scanline Effect -->
            <div class="pointer-events-none absolute inset-0 bg-[linear-gradient(rgba(18,16,16,0)_50%,rgba(0,0,0,0.15)_50%),linear-gradient(90deg,rgba(255,0,0,0.03),rgba(0,255,0,0.01),rgba(0,0,255,0.03))] z-0 bg-[length:100%_2px,3px_100%] opacity-20"></div>
            
            <div class="relative z-10 text-center">
                <h3 class="text-xl font-mono text-white mb-6 flex items-center justify-center gap-2 uppercase tracking-wider">
                    <span class="w-2 h-2 bg-[hsl(var(--primary))] rounded-full animate-pulse"></span>
                    > INITIATE_TRANSFER
                </h3>

                <p class="text-zinc-400 font-mono mb-8 max-w-lg mx-auto">
                    Secure channel established. Click below to proceed with the transaction via verified gateways (GoPay, ShopeePay, BCA, Mandiri, Credit Card).
                </p>

                <button id="pay-button" class="w-full md:w-auto px-12 py-4 bg-red-700 hover:bg-red-600 text-white font-bold rounded-lg uppercase tracking-widest transition-all shadow-[0_0_20px_rgba(220,38,38,0.3)] hover:shadow-[0_0_30px_rgba(220,38,38,0.5)] font-mono flex items-center justify-center gap-3 mx-auto">
                    <span>> EXECUTE_PAYMENT</span>
                </button>
            </div>
        </div>

        <!-- Cancel Button -->
        <form id="cancel-payment-form" action="{{ route('payment.cancel', $booking->id) }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="w-full py-3 bg-zinc-800 hover:bg-zinc-700 text-zinc-400 hover:text-white font-mono text-sm uppercase tracking-widest transition-all border border-zinc-700 rounded-lg">
                [X] Abort Transaction
            </button>
        </form>

        <!-- Security Notice -->
        <div class="mt-6 p-4 bg-zinc-900/30 border border-zinc-800 rounded-lg">
            <div class="flex items-start gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-green-500 flex-shrink-0 mt-0.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                <div class="text-xs text-zinc-500 font-mono leading-relaxed">
                    <strong class="text-green-500">SECURE CONNECTION:</strong> All transactions are encrypted and protected by Hawkins Lab security protocols. Powered by Midtrans Gateway.
                </div>
            </div>
        </div>
    </div>

    <!-- DEV BYPASS COMPONENT -->
    <div class="max-w-3xl mx-auto px-4 mt-8 mb-12">
        <details class="cursor-pointer group">
            <summary class="text-zinc-800 text-xs font-mono uppercase tracking-widest list-none text-center select-none hover:text-red-900 transition-colors">
                [ DEV_OVERRIDE_CONTROLS ]
            </summary>
            
            <div class="mt-4 p-4 border border-red-900/20 bg-red-900/5 rounded-lg">
                <form action="{{ route('payment.dev-bypass', $booking->id) }}" method="POST" class="flex gap-2">
                    @csrf
                    <input type="password" name="dev_password" placeholder="ENTER SECURITY CODE" 
                           class="bg-black border border-red-900/30 text-red-500 font-mono text-xs px-3 py-2 rounded flex-grow focus:outline-none focus:border-red-500">
                    <button type="submit" class="bg-red-900/20 hover:bg-red-900/50 text-red-500 border border-red-900/50 text-xs font-mono px-4 py-2 rounded uppercase tracking-widest transition-colors">
                        Bypass
                    </button>
                </form>
                <p class="text-[10px] text-red-900/50 font-mono mt-2 text-center uppercase">Warning: Unauthorized access will be logged.</p>
            </div>
        </details>
    </div>

    <!-- Midtrans Snap Script -->
    <script src="{{ config('services.midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
    <script type="text/javascript">
      // Countdown for Payment Page
      // We use server-provided remaining seconds to avoid timezone issues
      let remainingSeconds = {{ $remainingTime }};
      
      const timerInterval = setInterval(function() {
          remainingSeconds--;
          
          if (remainingSeconds < 0) {
              clearInterval(timerInterval);
              alert("Payment session expired. Please book again.");
              // Submit the cancel form to properly trigger the POST request
              document.getElementById('cancel-payment-form').submit();
          }
          
          // Optional: Display the timer if you add an element with id="timer"
          // const minutes = Math.floor(remainingSeconds / 60);
          // const seconds = remainingSeconds % 60;
          // document.getElementById("timer").innerText = 
          //    (minutes < 10 ? "0" + minutes : minutes) + ":" + 
          //    (seconds < 10 ? "0" + seconds : seconds);
      }, 1000);

      document.getElementById('pay-button').onclick = function(){
        snap.pay('{{ $snapToken }}', {
          onSuccess: function(result){
            /* You may add your own implementation here */
            window.location.href = "{{ route('payment.process', $booking->id) }}?json_callback=" + JSON.stringify(result);
          },
          onPending: function(result){
            /* You may add your own implementation here */
            window.location.href = "{{ route('payment.process', $booking->id) }}?json_callback=" + JSON.stringify(result);
          },
          onError: function(result){
            /* You may add your own implementation here */
            window.location.href = "{{ route('payment.process', $booking->id) }}?json_callback=" + JSON.stringify(result);
          },
          onClose: function(){
            /* You may add your own implementation here */
            // Don't alert or force fail, just let them stay or go back
            console.log('Popup closed');
          }
        })
      };
    </script>
@endsection
