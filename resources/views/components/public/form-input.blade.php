<div>
    <label for="{{ $id }}" class="block text-sm font-medium text-foreground">{{ $label }}</label>
    <div class="mt-1">
        <input 
            type="{{ $type ?? 'text' }}" 
            name="{{ $name ?? $id }}" 
            id="{{ $id }}" 
            @if(isset($autocomplete)) autocomplete="{{ $autocomplete }}" @endif
            class="py-3 px-4 block w-full shadow-sm focus:ring-primary focus:border-primary border border-border rounded-md bg-card/50 text-foreground backdrop-blur-sm"
            @if(isset($placeholder)) placeholder="{{ $placeholder }}" @endif
        >
    </div>
</div>