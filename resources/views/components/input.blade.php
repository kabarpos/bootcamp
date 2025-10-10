@props(['disabled' => false])

<input
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge([
        'class' => 'w-full rounded-2xl border border-white/10 bg-slate-900/70 px-4 py-3 text-sm text-white placeholder:text-slate-500 outline-none transition focus:border-sky-400/70 focus:ring-2 focus:ring-sky-500/40 disabled:cursor-not-allowed disabled:opacity-60'
    ]) !!}
>
