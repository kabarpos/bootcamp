<div class="bg-gradient-to-r {{ $gradient }} overflow-hidden shadow-lg rounded-xl">
    <div class="p-6 text-white">
        <div class="flex items-center">
            @if($icon)
                <div class="flex-shrink-0">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}" />
                    </svg>
                </div>
            @endif
            <div class="ml-4">
                <div class="text-sm font-medium text-white/80">
                    {{ $title }}
                </div>
                <div class="text-2xl font-bold">
                    {{ $value }}
                </div>
                <p class="text-xs text-white/70">
                    {{ $subtitle }}
                </p>
            </div>
        </div>
    </div>
</div>
