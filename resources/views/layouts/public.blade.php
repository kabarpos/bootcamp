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
    <body class="font-sans antialiased bg-slate-950 text-slate-200" style="font-family: 'Manrope', sans-serif;">
        <div class="relative min-h-screen overflow-hidden">
            <div class="pointer-events-none absolute inset-0">
                <div class="absolute inset-0 bg-slate-950/85"></div>
                <div class="absolute -top-32 -left-40 h-96 w-96 rounded-full bg-primary/30 blur-[140px]"></div>
                <div class="absolute top-1/3 right-[-120px] h-[26rem] w-[26rem] rounded-full bg-sky-500/25 blur-[160px]"></div>
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(148,163,235,0.18),_transparent_60%),radial-gradient(circle_at_bottom_right,_rgba(14,165,233,0.22),_transparent_55%)]"></div>
                <div class="absolute inset-0 bg-[linear-gradient(115deg,rgba(255,255,255,0.08)_0%,rgba(15,23,42,0)_28%,rgba(30,41,59,0.35)_58%,rgba(14,116,144,0.15)_100%)] mix-blend-overlay"></div>
            </div>

            <div class="relative z-10 flex min-h-screen flex-col">
                <x-public.navigation />

                <!-- Page Content -->
                <main class="flex-1">
                    @yield('content')
                </main>

                <x-public.footer />
            </div>
        </div>

        @stack('modals')
        @livewireScripts
    </body>
</html>
