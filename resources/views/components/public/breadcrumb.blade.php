<nav class="relative border-b border-white/10 bg-slate-950/70 backdrop-blur-2xl" aria-label="Breadcrumb">
    <div class="mx-auto max-w-7xl px-4 py-4 sm:px-6 lg:px-8">
        <ol class="flex flex-wrap items-center gap-3 text-xs font-semibold uppercase tracking-[0.32em] text-slate-500">
            @foreach($items as $item)
                @if(!$loop->last)
                    <li class="flex items-center gap-3">
                        <a href="{{ $item['url'] }}" class="rounded-full border border-white/10 bg-slate-900/60 px-3 py-1 text-slate-300 transition hover:border-sky-400/40 hover:text-white">
                            {{ $item['label'] }}
                        </a>
                        <svg class="h-4 w-4 text-slate-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </li>
                @else
                    <li class="rounded-full border border-sky-400/40 bg-sky-500/10 px-4 py-1 text-sky-200">
                        {{ $item['label'] }}
                    </li>
                @endif
            @endforeach
        </ol>
    </div>
</nav>
