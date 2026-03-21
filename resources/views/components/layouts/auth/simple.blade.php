<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-white antialiased bg-cover bg-center relative" 
      style="background-image: url('{{ asset('images/bgsnhs.jpg') }}');">

    <!-- Dark Gradient Overlay for readability -->
    <div class="absolute inset-0 bg-gradient-to-b from-black/50 via-black/30 to-black/20"></div>

    <!-- Page container -->
    <div class="relative z-10 flex min-h-screen flex-col items-center justify-center p-6 md:p-10">

        <!-- Login Card -->
        <div class="w-full max-w-md bg-white/80 dark:bg-neutral-900/80 backdrop-blur-xl
                    rounded-2xl shadow-2xl border border-green-500/60 p-10 relative">

            <!-- Logo Badge -->
            <div class="absolute -top-14 left-1/2 transform -translate-x-1/2 
                        bg-white rounded-full p-3 shadow-xl border-4 border-green-600">
                <img src="{{ asset('images/snhs.png') }}" 
                     alt="School Logo" 
                     class="h-20 w-20 rounded-full object-cover">
            </div>


            <!-- SLOT: Login form -->
            <div class="space-y-6 mt-8">
                {{ $slot }}
            </div>
        </div>

        <!-- Quote Section -->
        @php
            [$message, $author] = str(Illuminate\Foundation\Inspiring::quotes()->random())->explode('-');
        @endphp
        <blockquote class="mt-10 text-center max-w-xl px-6">
            <p class="italic text-gray-100 text-lg md:text-xl font-medium leading-relaxed drop-shadow">
                “{{ trim($message) }}”
            </p>
            <p class="mt-3 text-base font-bold text-gray-100 tracking-wide">
                – {{ trim($author) }}
            </p>
        </blockquote>
    </div>

    @fluxScripts
</body>
</html>
