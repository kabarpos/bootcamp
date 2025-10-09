@php
    $links = [
        ['label' => 'Home', 'route' => route('public.homepage'), 'active' => request()->routeIs('public.homepage')],
        ['label' => 'Bootcamps', 'route' => route('public.bootcamps'), 'active' => request()->routeIs('public.bootcamps') || request()->routeIs('public.bootcamp')],
        ['label' => 'About', 'route' => route('public.about'), 'active' => request()->routeIs('public.about')],
        ['label' => 'Contact', 'route' => route('public.contact'), 'active' => request()->routeIs('public.contact')],
    ];
    $brandName = config('app.name', 'NovaTech Bootcamp');
    $brandSegments = explode(' ', trim($brandName), 2);
    $brandPrimary = $brandSegments[0] ?? $brandName;
    $brandSecondary = $brandSegments[1] ?? 'Bootcamp';
@endphp

<nav x-data="{ mobileMenuOpen: false }" class="sticky top-0 z-50 border-b border-white/10 bg-slate-950/80 backdrop-blur-2xl">
    <div class="mx-auto flex h-18 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-8">
            <a href="{{ route('public.homepage') }}" class="group flex items-center gap-3 text-slate-200 transition-colors hover:text-white">
                <span class="relative flex h-10 w-10 items-center justify-center rounded-2xl bg-gradient-to-br from-sky-400 via-indigo-500 to-blue-700 text-lg font-semibold text-white shadow-[0_10px_30px_-12px_rgba(14,165,233,0.6)]">
                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                        <path d="M12 3v8.25L16.5 9M12 11.25L7.5 9M12 12.75V21" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.5 8.25V15a4.5 4.5 0 004.5 4.5h6a4.5 4.5 0 004.5-4.5V8.25a4.5 4.5 0 00-3.197-4.3l-4.5-1.35a1.5 1.5 0 00-.806 0l-4.5 1.35A4.5 4.5 0 004.5 8.25z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </span>
                <div class="flex flex-col leading-tight">
                    <span class="text-xs uppercase tracking-[0.22em] text-sky-300/80 group-hover:text-sky-200">{{ $brandSecondary }}</span>
                    <span class="text-lg font-semibold">{{ $brandPrimary }}</span>
                </div>
            </a>

            <div class="hidden items-center gap-6 md:flex">
                @foreach($links as $link)
                    @php
                        $baseClasses = 'relative text-sm font-semibold tracking-wide text-slate-300/80 transition-colors hover:text-slate-50';
                        $classes = $link['active'] ? $baseClasses . ' nav-link-active' : $baseClasses;
                    @endphp
                    <a href="{{ $link['route'] }}" class="{{ $classes }}">
                        {{ $link['label'] }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="hidden items-center gap-4 md:flex">
            <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300/80 transition-colors hover:text-white">Log in</a>
            <x-public.button href="{{ route('register') }}" class="shadow-xl" data-umami-event="primary-cta-register">
                Join the Cohort
            </x-public.button>
        </div>

        <div class="-mr-2 flex items-center md:hidden">
            <button
                @click="mobileMenuOpen = !mobileMenuOpen"
                type="button"
                class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-slate-900/50 p-2 text-slate-200 transition hover:bg-slate-800/60 focus:outline-none focus:ring-2 focus:ring-sky-400">
                <span class="sr-only">Open main menu</span>
                <svg x-show="!mobileMenuOpen" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 8h16M4 12h16M4 16h16" />
                </svg>
                <svg x-show="mobileMenuOpen" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <div
        x-show="mobileMenuOpen"
        x-transition
        class="border-t border-white/10 bg-slate-950/95 px-4 pb-6 pt-4 shadow-2xl md:hidden"
        id="mobile-menu">
        <div class="space-y-2">
            @foreach($links as $link)
                <a
                    href="{{ $link['route'] }}"
                    class="block rounded-xl border border-white/[0.08] bg-slate-900/60 px-4 py-3 text-base font-medium text-slate-200 transition hover:border-sky-500/40 hover:text-white {{ $link['active'] ? 'ring-1 ring-inset ring-sky-400/60' : '' }}">
                    {{ $link['label'] }}
                </a>
            @endforeach
            <div class="mt-4 grid gap-2">
                <a href="{{ route('login') }}" class="block rounded-xl border border-white/[0.08] bg-slate-900/60 px-4 py-3 text-base font-medium text-slate-200 transition hover:border-sky-500/40 hover:text-white">
                    Log in
                </a>
                <x-public.button href="{{ route('register') }}" class="w-full justify-center">
                    Join the Cohort
                </x-public.button>
            </div>
        </div>
    </div>
</nav>
