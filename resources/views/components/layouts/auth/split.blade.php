<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-black antialiased">
        <div class="relative grid h-dvh flex-col items-center justify-center px-8 sm:px-0 lg:max-w-none lg:grid-cols-2 lg:px-0">
            <!-- Left Panel -->
            <div class="relative hidden h-full flex-col items-center justify-center p-10 text-black dark:text-white lg:flex border-e border-neutral-200 dark:border-neutral-800 bg-white dark:bg-black">
                <div class="relative z-20 flex flex-col items-center space-y-4">
                    <!-- School Logo -->
                    <img src="{{ asset('images/snhs.png') }}" alt="School Logo" class="w-40 h-40 object-contain" />

                    <!-- School Name -->
                    <div class="text-center space-y-1">
                        <flux:heading size="xl" class="font-bold">San Isidro National High School</flux:heading>
                        <flux:heading size="sm" class="text-gray-700 dark:text-gray-300">Tanauan, Leyte</flux:heading>
                    </div>

                    <!-- Quote -->
                    @php
                        [$message, $author] = str(Illuminate\Foundation\Inspiring::quotes()->random())->explode('-');
                    @endphp
                    <blockquote class="mt-10 text-center space-y-1">
                        <flux:heading size="sm" class="italic text-gray-800 dark:text-gray-200">“{{ trim($message) }}”</flux:heading>
                        <flux:heading size="xs" class="text-gray-500 dark:text-gray-400">– {{ trim($author) }}</flux:heading>
                    </blockquote>
                </div>
            </div>

            <!-- Right Panel -->
            <div class="w-full lg:p-8 bg-white dark:bg-black text-black dark:text-white">
                <div class="mx-auto flex w-full flex-col justify-center space-y-6 sm:w-[350px]">
                    <a href="{{ route('home') }}" class="z-20 flex flex-col items-center gap-2 font-medium lg:hidden" wire:navigate>
                        <span class="flex h-9 w-9 items-center justify-center rounded-md">
                            <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" />
                        </span>
                        <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                    </a>
                    {{ $slot }}
                </div>
            </div>
        </div>

        @fluxScripts
    </body>
</html>
