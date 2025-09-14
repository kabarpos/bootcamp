@props(['href' => '#', 'type' => 'anchor', 'variant' => 'primary'])

@php
$baseClasses = 'inline-flex items-center justify-center px-5 py-3 border text-base font-medium rounded-md cursor-pointer backdrop-blur-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-all duration-300';
$primaryClasses = 'border-transparent text-primary bg-white hover:bg-gray-50 btn-primary bg-white/90 hover:bg-white shadow-md hover:shadow-lg';
$secondaryClasses = 'border-white border-opacity-30 text-white bg-white/10 hover:bg-white/20 btn-primary hover:bg-white/30 shadow-md hover:shadow-lg';
$classes = $baseClasses . ' ' . ($variant === 'secondary' ? $secondaryClasses : $primaryClasses);
@endphp

@if($type === 'anchor')
<a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
@else
<button {{ $attributes->merge(['class' => $classes, 'type' => $type]) }}>
    {{ $slot }}
</button>
@endif