<div class="text-center">
    @if(isset($subtitle))
    <h2 class="text-base font-semibold text-primary tracking-wide uppercase">{{ $subtitle }}</h2>
    @endif
    <p class="mt-2 text-3xl font-extrabold text-foreground sm:text-4xl">
        {{ $title }}
    </p>
    @if(isset($description))
    <p class="mt-4 max-w-2xl text-xl text-muted-foreground mx-auto">
        {{ $description }}
    </p>
    @endif
</div>