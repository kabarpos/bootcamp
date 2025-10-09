<div x-data="{ open: false }" class="glass-card overflow-hidden rounded-[24px] border border-white/10">
    <button
        @click="open = !open"
        type="button"
        class="flex w-full items-center justify-between px-6 py-5 text-left text-white transition">
        <span class="text-base font-semibold">{{ $question }}</span>
        <span class="flex h-9 w-9 items-center justify-center rounded-full border border-white/10 bg-slate-900/60 text-slate-300">
            <svg x-show="!open" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6v12m6-6H6" />
            </svg>
            <svg x-show="open" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M18 12H6" />
            </svg>
        </span>
    </button>
    <div x-show="open" x-collapse class="border-t border-white/5 px-6 py-5 text-sm text-slate-300">
        {{ $answer }}
    </div>
</div>
