<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-background via-card/30 to-primary/5">
    <div class="w-full sm:max-w-md px-6 py-4 bg-card/80 backdrop-blur-sm border border-border shadow-xl overflow-hidden rounded-xl sm:rounded-2xl my-6 sm:my-0">
        @if (isset($logo))
            <div class="flex justify-center py-4">
                {{ $logo }}
            </div>
        @endif

        <div class="w-full">
            {{ $slot }}
        </div>
    </div>
</div>