@props(['showHeader' => true, 'title' => null, 'description' => null])

<div class="space-y-6 lg:col-span-1">
    @if($showHeader)
        <div class="glass-card relative overflow-hidden rounded-[28px] p-6">
            <span class="spotlight-ring"></span>
            <h3 class="text-lg font-semibold text-white">{{ $title ?? 'Contact Information' }}</h3>
            <p class="mt-3 text-sm text-slate-300">
                {{ $description ?? "Fill out the form and we'll get back to you as soon as possible." }}
            </p>
        </div>
    @endif
    {{ $slot }}
</div>
