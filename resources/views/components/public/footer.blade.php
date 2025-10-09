@php
    $brandName = config('app.name', 'NovaTech Bootcamp');
    $brandTagline = $tagline ?? 'Craft your next role';
@endphp

<footer class="relative border-t border-white/10 bg-slate-950/80 backdrop-blur-2xl">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(99,102,241,0.25),_transparent_65%)] opacity-60"></div>
    <div class="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
        <div class="grid gap-12 lg:grid-cols-[1.2fr_0.8fr]">
            <div class="space-y-6">
                <a href="{{ route('public.homepage') }}" class="flex items-center gap-3 text-white">
                    <span class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-sky-400 via-indigo-500 to-blue-700 text-lg font-semibold shadow-[0_10px_35px_-18px_rgba(59,130,246,0.85)]">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none">
                            <path d="M12 3v8.25L16.5 9M12 11.25L7.5 9M12 12.75V21" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4.5 8.25V15a4.5 4.5 0 004.5 4.5h6a4.5 4.5 0 004.5-4.5V8.25a4.5 4.5 0 00-3.197-4.3l-4.5-1.35a1.5 1.5 0 00-.806 0l-4.5 1.35A4.5 4.5 0 004.5 8.25z" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </span>
                    <div class="flex flex-col">
                        <span class="text-xs uppercase tracking-[0.28em] text-slate-400">{{ $brandName }}</span>
                        <span class="text-lg font-semibold">{{ $brandTagline }}</span>
                    </div>
                </a>
                <p class="max-w-md text-sm text-slate-300">
                    We help Southeast Asia's next wave of builders launch meaningful tech careers through project-driven learning,
                    dedicated mentorship, and outcomes-focused career support.
                </p>
                <div class="flex items-center gap-4">
                    <a href="https://www.linkedin.com" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/10 text-slate-300 transition hover:border-sky-400/60 hover:text-white">
                        <span class="sr-only">LinkedIn</span>
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M16.5 8a6.5 6.5 0 016.5 6.5V21h-4v-6.5a2.5 2.5 0 00-5 0V21h-4v-9h4v1.4A4.5 4.5 0 0116.5 8zM6 9H2v12h4V9zm-2-.5A2.5 2.5 0 116.5 6 2.5 2.5 0 014 8.5z" />
                        </svg>
                    </a>
                    <a href="https://twitter.com" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/10 text-slate-300 transition hover:border-sky-400/60 hover:text-white">
                        <span class="sr-only">Twitter / X</span>
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18.243 2H21l-6.5 7.424L22 22h-6.5l-4.333-7.07L5.9 22H3.143l7-7.952L2 2h6.5l3.853 6.303L18.243 2zm-1.146 17.181h2.023L7.02 4.706H4.858l12.239 14.475z" />
                        </svg>
                    </a>
                    <a href="https://instagram.com" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/10 text-slate-300 transition hover:border-sky-400/60 hover:text-white">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M7 2h10a5 5 0 015 5v10a5 5 0 01-5 5H7a5 5 0 01-5-5V7a5 5 0 015-5zm5 6.3A4.7 4.7 0 1016.7 13 4.7 4.7 0 0012 8.3zm0 1.8A2.9 2.9 0 119.1 13 2.9 2.9 0 0112 10.1zM18.3 5.7a1.3 1.3 0 11-1.3 1.3 1.3 1.3 0 011.3-1.3z" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-8 text-sm text-slate-300 sm:grid-cols-3">
                <div class="space-y-4">
                    <h4 class="text-xs font-semibold uppercase tracking-[0.28em] text-slate-400">Programs</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('public.bootcamps') }}" class="transition hover:text-white">Full-stack Catalyst</a></li>
                        <li><a href="{{ route('public.bootcamps') }}" class="transition hover:text-white">Product Design Lab</a></li>
                        <li><a href="{{ route('public.bootcamps') }}" class="transition hover:text-white">Data &amp; AI Sprint</a></li>
                        <li><a href="{{ route('public.bootcamps') }}" class="transition hover:text-white">DevOps Velocity</a></li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h4 class="text-xs font-semibold uppercase tracking-[0.28em] text-slate-400">Resources</h4>
                    <ul class="space-y-3">
                        <li><a href="{{ route('public.about') }}" class="transition hover:text-white">About {{ $brandName }}</a></li>
                        <li><a href="{{ route('public.contact') }}" class="transition hover:text-white">Admissions team</a></li>
                        <li><a href="#" class="transition hover:text-white">Scholarships</a></li>
                        <li><a href="#" class="transition hover:text-white">Corporate training</a></li>
                    </ul>
                </div>
                <div class="space-y-4">
                    <h4 class="text-xs font-semibold uppercase tracking-[0.28em] text-slate-400">Company</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="transition hover:text-white">Privacy policy</a></li>
                        <li><a href="#" class="transition hover:text-white">Terms of service</a></li>
                        <li><a href="#" class="transition hover:text-white">Partner with us</a></li>
                        <li><a href="#" class="transition hover:text-white">Alumni stories</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="mt-12 border-t border-white/10 pt-6 text-xs text-slate-500 sm:flex sm:items-center sm:justify-between">
            <p>&copy; {{ date('Y') }} {{ $brandName }}. All rights reserved.</p>
            <p>Crafted in Jakarta - Serving learners across Southeast Asia.</p>
        </div>
    </div>
</footer>
