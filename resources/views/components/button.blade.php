<button
    {{ $attributes->merge([
        'type' => 'submit',
        'class' => 'inline-flex items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-sky-500 to-indigo-500 px-5 py-3 text-sm font-semibold text-white shadow-[0_18px_45px_-20px_rgba(56,189,248,0.95)] transition hover:from-sky-400 hover:to-indigo-400 focus:outline-none focus:ring-2 focus:ring-sky-300/60 focus:ring-offset-0 disabled:cursor-not-allowed disabled:opacity-60'
    ]) }}
>
    {{ $slot }}
</button>
