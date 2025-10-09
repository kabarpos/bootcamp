<article class="glass-card relative h-full overflow-hidden rounded-[26px] p-6">
    <span class="spotlight-ring"></span>
    <div class="relative flex h-full flex-col gap-5">
        <div class="flex items-center gap-4">
            <img class="h-14 w-14 rounded-2xl object-cover ring-2 ring-white/10" src="{{ $image }}" alt="{{ $name }}">
            <div>
                <h4 class="text-base font-semibold text-white">{{ $name }}</h4>
                <p class="text-xs uppercase tracking-[0.28em] text-slate-400">{{ $position }}</p>
            </div>
        </div>

        <p class="flex-1 text-sm text-slate-300">
            {{ $content }}
        </p>

        <div class="flex items-center justify-between text-xs text-slate-400">
            <div class="flex items-center gap-2">
                <x-public.rating :stars="$rating ?? 5" />
                <span>{{ $rating ?? 5 }}/5</span>
            </div>
            <span>{{ $date }}</span>
        </div>
    </div>
</article>
