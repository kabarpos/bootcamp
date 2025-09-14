<div class="flex items-center justify-between py-3 {{ $class ?? '' }}">
    <dt class="text-sm font-medium text-foreground">{{ $label }}</dt>
    <dd class="text-sm {{ $valueClass ?? 'text-muted-foreground' }}">{{ $value }}</dd>
</div>