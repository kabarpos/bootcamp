<div class="pt-6">
    <div class="flow-root bg-card/80 backdrop-blur-sm rounded-lg px-6 pb-8 border border-border shadow-lg">
        <div class="-mt-6">
            <div>
                <x-public.feature-icon>
                    {{ $icon }}
                </x-public.feature-icon>
            </div>
            <h3 class="mt-8 text-lg font-medium text-foreground tracking-tight">{{ $title }}</h3>
            <p class="mt-5 text-base text-muted-foreground">
                {{ $description }}
            </p>
        </div>
    </div>
</div>