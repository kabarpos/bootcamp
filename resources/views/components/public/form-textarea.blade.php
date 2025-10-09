<div {{ $attributes->class('flex flex-col gap-2 md:col-span-2') }}>
    <label for="{{ $id }}" class="text-xs font-semibold uppercase tracking-[0.28em] text-slate-400">{{ $label }}</label>
    <textarea 
        id="{{ $id }}" 
        name="{{ $name ?? $id }}" 
        rows="{{ $rows ?? 4 }}" 
        class="w-full rounded-2xl border border-white/10 bg-slate-900/60 px-4 py-3 text-sm text-slate-200 placeholder:text-slate-500 focus:border-sky-400 focus:outline-none focus:ring-2 focus:ring-sky-400/30"
        @if(isset($placeholder)) placeholder="{{ $placeholder }}" @endif
    ></textarea>
</div>
