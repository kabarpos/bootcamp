@props(['submit'])

<div {{ $attributes->merge(['class' => 'grid gap-8 lg:grid-cols-[0.8fr_1.2fr] items-start']) }}>
    <x-section-title>
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </x-section-title>

    <div class="relative">
        <div class="pointer-events-none absolute -inset-[1px] -z-10 rounded-[36px] bg-gradient-to-br from-sky-500/15 via-indigo-500/10 to-blue-600/15 blur-xl"></div>

        <form
            wire:submit="{{ $submit }}"
            class="relative overflow-hidden rounded-[32px] border border-white/10 bg-slate-950/80 p-6 shadow-[0_45px_120px_-50px_rgba(30,64,175,0.85)] backdrop-blur-2xl sm:p-10"
        >
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-6">
                {{ $form }}
            </div>

            @if (isset($actions))
                <div class="mt-8 flex flex-wrap items-center justify-end gap-4 border-t border-white/5 pt-6">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
</div>
