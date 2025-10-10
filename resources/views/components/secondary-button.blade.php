<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'inline-flex items-center justify-center gap-2 rounded-2xl border border-white/15 bg-slate-900/70 px-5 py-3 text-sm font-semibold text-slate-200 transition hover:border-sky-400/40 hover:text-white focus:outline-none focus:ring-2 focus:ring-sky-400/40 focus:ring-offset-0 disabled:cursor-not-allowed disabled:opacity-50'
    ]) }}
>
    {{ $slot }}
</button>
