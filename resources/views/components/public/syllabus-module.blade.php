<!-- Module -->
<div class="bg-card/80 backdrop-blur-sm rounded-lg shadow border border-border">
    <div class="px-6 py-4 border-b border-border">
        <h3 class="text-lg font-medium text-foreground">{{ $title }}</h3>
    </div>
    <div class="px-6 py-4">
        <ul class="list-disc pl-5 space-y-2 text-muted-foreground">
            {{ $slot }}
        </ul>
    </div>
</div>