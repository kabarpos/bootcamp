<div class="glass-card relative overflow-hidden rounded-[24px] p-6">
    <span class="spotlight-ring"></span>
    <div class="relative flex items-start gap-4">
        <div class="flex h-10 w-10 items-center justify-center rounded-2xl border border-white/10 bg-slate-900/70 text-sky-300">
            {{ $icon }}
        </div>
        <div class="text-sm text-slate-200">
            <p>{{ $line1 }}</p>
            @if(isset($line2))
                <p class="mt-1 text-xs text-slate-400">{{ $line2 }}</p>
            @endif
        </div>
    </div>
</div>
