@php
    $title = $title ?? 'The NovaTech impact';
    $description = $description ?? 'Learners around the region trust NovaTech to build career-defining skills and unlock roles with top engineering teams.';
@endphp

<section class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(56,189,248,0.12),_transparent_65%)]"></div>

    <div class="relative mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <h2 class="text-3xl font-bold text-white sm:text-4xl">{{ $title }}</h2>
            <p class="mt-4 text-sm text-slate-300 sm:text-base">{{ $description }}</p>
        </div>

        <div class="mt-12 grid gap-6 md:grid-cols-2">
            {{ $slot }}
        </div>
    </div>
</section>
