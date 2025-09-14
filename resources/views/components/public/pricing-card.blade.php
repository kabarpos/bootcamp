<div class="bg-card/80 backdrop-blur-sm border border-border rounded-lg shadow-sm overflow-hidden flex flex-col h-full {{ (isset($featured) && $featured) ? 'ring-2 ring-primary' : '' }}">
    @if(isset($featured) && $featured)
    <div class="bg-primary text-white text-center py-2 text-sm font-medium">
        {{ $featuredText ?? 'Most Popular' }}
    </div>
    @endif
    <div class="p-6 flex-grow">
        <h3 class="text-2xl font-bold text-foreground">{{ $title }}</h3>
        <div class="mt-4 flex items-baseline">
            <span class="text-4xl font-extrabold text-foreground">{{ $price }}</span>
            @if(isset($frequency))
            <span class="ml-1 text-xl font-medium text-muted-foreground">/{{ $frequency }}</span>
            @endif
        </div>
        @if(isset($description))
        <p class="mt-2 text-muted-foreground">{{ $description }}</p>
        @endif
        <ul class="mt-6 space-y-4">
            {{ $slot }}
        </ul>
    </div>
    <div class="p-6 pt-0">
        <x-public.button 
            href="{{ $buttonLink ?? '#' }}" 
            variant="{{ (isset($featured) && $featured) ? 'primary' : 'secondary' }}" 
            class="w-full"
            {{ $attributes }}
        >
            {{ $buttonText ?? 'Get started' }}
        </x-public.button>
    </div>
</div>