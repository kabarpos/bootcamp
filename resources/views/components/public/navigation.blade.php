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
    $user = auth()->user();
    $isDashboard = request()->routeIs('public.dashboard');
    $nameParts = $user ? preg_split('/\s+/', trim($user->name)) : [];
    $initials = $user
        ? collect($nameParts)
            ->filter(fn ($part) => $part !== '')
            ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
            ->take(2)
            ->implode('')
        : '';
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
                <div class="leading-tight">
                    <span class="text-lg uppercase tracking-[0.22em] text-sky-300/80 group-hover:text-sky-200">{{ $brandSecondary }}</span>
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
            @guest
                <a href="{{ route('login') }}" class="text-sm font-medium text-slate-300/80 transition-colors hover:text-white">Log in</a>
                <x-public.button href="{{ route('register') }}" class="shadow-xl" data-umami-event="primary-cta-register">
                    Join the Cohort
                </x-public.button>
            @else
                @if ($isDashboard)
                    <div x-data="{ open: false }" class="relative">
                        <button
                            @click="open = !open"
                            @keydown.escape.window="open = false"
                            type="button"
                            class="flex items-center gap-3 rounded-full border border-white/10 bg-slate-900/60 px-3 py-1.5 text-sm font-medium text-slate-200 transition hover:border-sky-400/50 hover:text-white focus:outline-none focus:ring-2 focus:ring-sky-400/40"
                        >
                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500/70 to-sky-500/70 text-sm font-semibold text-white">
                                {{ $initials ?: strtoupper(substr($user->email, 0, 1)) }}
                            </span>
                            <span class="text-left leading-tight">
                                <span class="block text-xs text-slate-400/80">Akun kamu</span>
                                <span class="block text-sm font-semibold text-white">{{ $user->name }}</span>
                            </span>
                            <svg class="h-4 w-4 text-slate-400 transition" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 9l6 6 6-6" />
                            </svg>
                        </button>
                        <div
                            x-cloak
                            x-show="open"
                            x-transition
                            @click.away="open = false"
                            class="absolute right-0 mt-3 w-56 overflow-hidden rounded-2xl border border-white/10 bg-slate-950/95 shadow-2xl backdrop-blur-xl"
                        >
                            <a
                                href="{{ route('profile.show') }}"
                                class="block px-4 py-3 text-sm font-medium text-slate-200 transition hover:bg-slate-900/80 hover:text-white"
                            >
                                Edit Profile
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button
                                    type="submit"
                                    class="flex w-full items-center justify-between px-4 py-3 text-sm font-semibold text-rose-300 transition hover:bg-rose-500/10 hover:text-rose-200"
                                >
                                    Logout
                                    <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l3 3m0 0l-3 3m3-3H3" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <x-public.button href="{{ route('public.dashboard') }}" variant="secondary">
                        Student Dashboard
                    </x-public.button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-public.button type="submit" class="!rounded-full !border-white/15 !bg-slate-900/70 !text-slate-200 hover:!border-rose-400/40 hover:!text-white">
                            Logout
                        </x-public.button>
                    </form>
                @endif
            @endguest
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
                @guest
                    <a href="{{ route('login') }}" class="block rounded-xl border border-white/[0.08] bg-slate-900/60 px-4 py-3 text-base font-medium text-slate-200 transition hover:border-sky-500/40 hover:text-white">
                        Log in
                    </a>
                    <x-public.button href="{{ route('register') }}" class="w-full justify-center">
                        Join the Cohort
                    </x-public.button>
                @else
                    @if ($isDashboard)
                        <a href="{{ route('profile.show') }}" class="block rounded-xl border border-white/[0.08] bg-slate-900/60 px-4 py-3 text-base font-semibold text-slate-200 transition hover:border-sky-500/40 hover:text-white">
                            Edit Profile
                        </a>
                    @else
                        <a href="{{ route('public.dashboard') }}" class="block rounded-xl border border-white/[0.08] bg-slate-900/60 px-4 py-3 text-base font-semibold text-slate-200 transition hover:border-sky-500/40 hover:text-white">
                            Student Dashboard
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-rose-500/30 bg-rose-500/10 px-4 py-3 text-base font-semibold text-rose-200 transition hover:border-rose-400/50 hover:text-white"
                        >
                            Logout
                        </button>
                    </form>
                @endguest
            </div>
        </div>
    </div>
</nav>
