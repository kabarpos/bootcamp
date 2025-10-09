@props(['href' => '#', 'type' => 'anchor', 'variant' => 'primary'])

@php
    $baseClasses = 'inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-full border px-6 py-3.5 text-sm font-semibold tracking-wide transition-all duration-300 focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-sky-400';
    $primaryClasses = 'border-transparent text-white button-primary-gradient shadow-[0_18px_30px_-20px_rgba(56,189,248,0.9)] hover:shadow-[0_18px_35px_-14px_rgba(99,102,241,0.7)]';
    $secondaryClasses = 'button-secondary-outline text-slate-200 hover:border-sky-400/40 hover:text-white';
    $classes = $baseClasses . ' ' . ($variant === 'secondary' ? $secondaryClasses : $primaryClasses);
@endphp

@if ($type === 'anchor')
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => $classes, 'type' => $type]) }}>
        {{ $slot }}
    </button>
@endif
