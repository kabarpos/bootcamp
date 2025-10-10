@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-6 sm:px-8">
        <div class="text-lg font-semibold text-white">
            {{ $title }}
        </div>

        <div class="mt-4 text-sm leading-relaxed text-slate-300/85">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end gap-3 border-t border-white/10 bg-slate-950/70 px-6 py-4 text-end sm:px-8">
        {{ $footer }}
    </div>
</x-modal>
