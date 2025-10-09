@php
    $align = $align ?? 'center';
    $maxWidth = $maxWidth ?? 'max-w-3xl';
    $alignmentClasses = [
        'center' => 'mx-auto text-center items-center',
        'left' => 'text-left items-start',
        'right' => 'ml-auto text-right items-end',
    ];
    $containerClass = $alignmentClasses[$align] ?? $alignmentClasses['center'];
@endphp

<div class="flex {{ $containerClass }} {{ $maxWidth }} flex-col gap-4">
    @if (isset($subtitle))
        <span class="inline-flex items-center gap-2 self-{{ $align === 'center' ? 'center' : ($align === 'left' ? 'start' : 'end') }} rounded-full border border-white/10 bg-slate-900/70 px-4 py-2 text-xs font-semibold uppercase tracking-[0.32em] text-sky-200/80">
            {{ $subtitle }}
            <span class="h-1.5 w-8 rounded-full bg-gradient-to-r from-sky-400 to-indigo-400"></span>
        </span>
    @endif

    <h2 class="text-3xl font-bold leading-tight text-white sm:text-4xl lg:text-5xl">
        {{ $title }}
    </h2>

    @if (isset($description))
        <p class="text-base text-slate-300 sm:text-lg">
            {{ $description }}
        </p>
    @endif
</div>
