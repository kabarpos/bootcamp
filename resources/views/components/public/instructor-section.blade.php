@php
    $subtitle = $subtitle ?? 'Meet Your Instructor';
    $title = $title ?? 'Industry Expert';
    $description = $description ?? 'Learn from senior practitioners who have shipped products at high-growth tech companies.';
@endphp

<section class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,_rgba(56,189,248,0.12),_transparent_60%)]"></div>
    <div class="relative mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <x-public.section-title 
            :subtitle="$subtitle"
            :title="$title"
            :description="$description"
            align="left"
            maxWidth="max-w-3xl"
        />
        
        <div class="mt-12 glass-panel rounded-[36px] border border-white/10 p-8">
            <div class="flex flex-col gap-10 lg:flex-row lg:items-center">
                <div class="flex w-full justify-center lg:w-1/3">
                    <div class="relative">
                        <span class="absolute -inset-4 rounded-full bg-gradient-to-tr from-sky-400/40 to-indigo-400/30 blur-3xl"></span>
                        <img class="relative h-64 w-64 rounded-3xl object-cover shadow-[0_30px_60px_-35px_rgba(56,189,248,0.7)]" src="{{ $image }}" alt="{{ $name }}">
                    </div>
                </div>
                <div class="flex-1 space-y-5 lg:w-2/3">
                    <div>
                        <h3 class="text-2xl font-semibold text-white">{{ $name }}</h3>
                        <p class="mt-2 text-xs uppercase tracking-[0.32em] text-sky-200">{{ $position }}</p>
                    </div>
                    <p class="text-sm text-slate-300">{{ $bio1 }}</p>
                    <p class="text-sm text-slate-300">{{ $bio2 }}</p>
                    <div class="flex items-center gap-3 text-sm text-slate-300">
                        {{ $rating ?? '' }}
                        @if(isset($reviews))
                            <span>{{ $reviews }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
