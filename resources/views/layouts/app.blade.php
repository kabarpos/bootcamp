<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=manrope:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body
        class="public-layout font-sans antialiased bg-slate-950 text-slate-200"
        x-data="{
            init() {
                const theme = localStorage.getItem('theme') || 'light';
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                }
            }
        }"
        style="font-family: 'Manrope', sans-serif;"
    >
        <x-banner />

        <div class="relative min-h-screen overflow-hidden">
            <div class="pointer-events-none absolute inset-0">
                <div class="absolute inset-0 bg-slate-950/88"></div>
                <div class="absolute -top-40 -left-48 h-[28rem] w-[28rem] rounded-full bg-primary/25 blur-[160px]"></div>
                <div class="absolute top-1/4 right-[-140px] h-[26rem] w-[26rem] rounded-full bg-sky-500/25 blur-[180px]"></div>
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(148,163,235,0.18),_transparent_60%),radial-gradient(circle_at_bottom_right,_rgba(14,165,233,0.22),_transparent_55%)]"></div>
                <div class="absolute inset-0 bg-[linear-gradient(120deg,rgba(255,255,255,0.08)_0%,rgba(15,23,42,0)_32%,rgba(30,41,59,0.35)_58%,rgba(14,116,144,0.18)_100%)] mix-blend-overlay"></div>
            </div>

            <div class="relative z-10 flex min-h-screen flex-col">
                <x-public.navigation />

                @if (isset($header))
                    <header class="border-b border-white/10 bg-slate-950/70 backdrop-blur-xl">
                        <div class="mx-auto w-full max-w-6xl px-4 py-10 sm:px-6 sm:py-12 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <main class="flex-1">
                    {{ $slot }}
                </main>

                <x-public.footer />
            </div>
        </div>

        @stack('modals')
        @livewireScripts
    </body>
</html>
