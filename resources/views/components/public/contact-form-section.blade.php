<div class="mt-12 lg:mt-0 lg:col-span-2">
    <div class="glass-card relative overflow-hidden rounded-[32px] border border-white/10 p-8 autofill-dark">
        <span class="spotlight-ring"></span>
        <form action="{{ $action ?? '#' }}" method="POST" class="grid grid-cols-1 gap-6 md:grid-cols-2">
            @csrf
            {{ $slot }}
        </form>
    </div>
</div>
