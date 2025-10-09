<li class="flex items-start gap-3 rounded-2xl border border-white/5 bg-white/5 px-3 py-3 text-sm text-slate-200">
    @if (!isset($icon) || $icon !== false)
        <span class="mt-0.5 flex h-6 w-6 items-center justify-center rounded-full bg-emerald-400/15 text-emerald-300">
            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none">
                <path d="M15.833 5.833l-7.5 7.5-3.333-3.333" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </span>
    @endif
    <span>{{ $feature }}</span>
</li>
