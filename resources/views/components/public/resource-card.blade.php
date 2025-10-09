@php
    $type = $type ?? 'document';
    $iconStyles = match($type) {
        'video' => ['classes' => 'border-rose-400/40 bg-rose-500/10 text-rose-200', 'icon' => 'M2 6a2 2 0 012-2h6a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v8a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z'],
        'link' => ['classes' => 'border-emerald-400/40 bg-emerald-500/10 text-emerald-200', 'icon' => 'M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z'],
        default => ['classes' => 'border-sky-400/40 bg-sky-500/10 text-sky-200', 'icon' => 'M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z']
    };
    $iconPath = $iconStyles['icon'];
    $iconClasses = $iconStyles['classes'];
@endphp

<article class="glass-card group flex h-full flex-col justify-between rounded-[26px] p-6">
    <span class="spotlight-ring"></span>
    <div class="flex items-start gap-4">
        <span class="flex h-12 w-12 items-center justify-center rounded-2xl border {{ $iconClasses }}">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="{{ $iconPath }}" clip-rule="evenodd" />
            </svg>
        </span>
        <div>
            <h3 class="text-lg font-semibold text-white">{{ $title }}</h3>
            <p class="mt-2 text-sm text-slate-300">{{ $description }}</p>
        </div>
    </div>

    <div class="mt-6 flex items-center justify-between border-t border-white/5 pt-4 text-xs text-slate-400">
        <span>{{ $size ?? 'Resource' }}</span>
        <x-public.button href="{{ $link ?? '#' }}" class="px-4 py-2 text-[0.75rem]">
            {{ $actionText ?? 'Access' }}
        </x-public.button>
    </div>
</article>
