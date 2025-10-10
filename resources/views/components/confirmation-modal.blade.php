@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 pt-6 pb-4 sm:px-8 sm:pb-6">
        <div class="sm:flex sm:items-start sm:gap-4">
            <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-2xl bg-rose-500/15 sm:mx-0 sm:size-12">
                <svg class="size-6 text-rose-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
            </div>

            <div class="mt-4 text-center sm:mt-0 sm:flex-1 sm:text-start">
                <h3 class="text-lg font-semibold text-white">
                    {{ $title }}
                </h3>

                <div class="mt-3 text-sm leading-relaxed text-slate-300/85">
                    {{ $content }}
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-row justify-end gap-3 border-t border-white/10 bg-slate-950/70 px-6 py-4 text-end sm:px-8">
        {{ $footer }}
    </div>
</x-modal>
