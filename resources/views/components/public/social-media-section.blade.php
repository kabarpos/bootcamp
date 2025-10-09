<div class="glass-card relative overflow-hidden rounded-[24px] p-6">
    <span class="spotlight-ring"></span>
    <h3 class="text-sm font-semibold uppercase tracking-[0.28em] text-slate-400">{{ $title ?? 'Follow Us' }}</h3>
    <div class="mt-4 flex flex-wrap gap-4">
        {{ $slot }}
    </div>
</div>
