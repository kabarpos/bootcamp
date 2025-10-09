<article class="glass-card group relative flex h-full flex-col items-center overflow-hidden rounded-[28px] p-8 text-center">
    <span class="spotlight-ring"></span>
    <div class="relative">
        <img class="h-32 w-32 rounded-3xl object-cover shadow-[0_20px_45px_-25px_rgba(56,189,248,0.9)]" src="{{ $image }}" alt="{{ $name }}">
        <span class="absolute inset-x-5 top-0 -z-10 h-32 rounded-full bg-gradient-to-b from-sky-500/30 via-transparent to-transparent blur-3xl opacity-60"></span>
    </div>
    <div class="mt-6 space-y-3">
        <h3 class="text-lg font-semibold text-white">{{ $name }}</h3>
        <p class="text-xs uppercase tracking-[0.32em] text-sky-200">{{ $position }}</p>
        <p class="text-sm text-slate-300">
            {{ $bio }}
        </p>
    </div>
</article>
