<div class="mt-6 bg-card/50 backdrop-blur-sm p-6 rounded-lg border border-border shadow-lg">
    <div class="flex items-start">
        <div class="flex-shrink-0">
            {{ $icon }}
        </div>
        <div class="ml-3 text-base text-muted-foreground">
            <p>{{ $line1 }}</p>
            @if(isset($line2))
            <p class="mt-1">{{ $line2 }}</p>
            @endif
        </div>
    </div>
</div>