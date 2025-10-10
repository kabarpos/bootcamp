<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' => 'inline-flex items-center justify-center gap-2 rounded-2xl border border-rose-500/40 bg-rose-500/15 px-5 py-3 text-sm font-semibold text-rose-100 transition hover:border-rose-400/60 hover:bg-rose-500/25 hover:text-white focus:outline-none focus:ring-2 focus:ring-rose-400/50 focus:ring-offset-0 disabled:cursor-not-allowed disabled:opacity-60'
    ]) }}
>
    {{ $slot }}
</button>
