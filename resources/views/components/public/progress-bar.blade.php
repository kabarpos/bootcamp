<div class="w-full bg-border rounded-full h-2.5">
    <div class="bg-primary h-2.5 rounded-full" style="width: {{ $percentage }}%"></div>
</div>
<div class="flex justify-between text-sm text-muted-foreground mt-1">
    <span>{{ $label ?? 'Progress' }}</span>
    <span>{{ $percentage }}%</span>
</div>