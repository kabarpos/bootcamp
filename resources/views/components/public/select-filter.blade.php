<div class="relative">
    <select class="appearance-none rounded-full border border-white/10 bg-slate-900/60 px-5 py-3 text-sm text-slate-200 shadow-[0_10px_25px_-20px_rgba(56,189,248,0.6)] focus:border-sky-400 focus:outline-none focus:ring-2 focus:ring-sky-400/30">
        <option>{{ $placeholder }}</option>
        {{ $slot }}
    </select>
    <span class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400">
        <svg class="h-4 w-4" viewBox="0 0 20 20" fill="none">
            <path d="M6 8l4 4 4-4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    </span>
</div>
