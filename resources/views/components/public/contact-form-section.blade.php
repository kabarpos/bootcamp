<div class="mt-12 lg:mt-0 lg:col-span-2">
    <div class="bg-card/80 backdrop-blur-sm shadow rounded-lg p-6 border border-border">
        <form action="{{ $action ?? '#' }}" method="POST" class="grid grid-cols-1 gap-y-6">
            @csrf
            {{ $slot }}
        </form>
    </div>
</div>