@php
    $titleLine1 = $titleLine1 ?? 'Ready to launch your next role?';
    $titleLine2 = $titleLine2 ?? 'Secure your spot before seats fill up.';
    $applyLink = $applyLink ?? route('register');
    $contactLink = $contactLink ?? '#contact';
    $applyText = $applyText ?? 'Apply now';
    $contactText = $contactText ?? 'Speak with admissions';
@endphp

<section class="relative py-24">
    <div class="absolute inset-0 bg-gradient-to-br from-sky-500/20 via-transparent to-indigo-500/20"></div>
    <div class="relative mx-auto max-w-6xl overflow-hidden rounded-[36px] border border-white/10 bg-slate-900/60 p-10 shadow-[0_35px_80px_-35px_rgba(37,99,235,0.55)]">
        <div class="absolute inset-y-0 right-[-60px] hidden w-72 rotate-6 rounded-full bg-gradient-to-br from-sky-400/40 via-transparent to-transparent blur-3xl md:block"></div>
        <div class="relative grid gap-10 md:grid-cols-[1.2fr_0.8fr] md:items-center">
            <div class="space-y-6">
                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-slate-900/50 px-4 py-2 text-xs font-semibold uppercase tracking-[0.32em] text-sky-200/80">
                    Cohort intake · January 2026
                </span>
                <h2 class="text-3xl font-bold leading-tight text-white sm:text-4xl">
                    <span class="block">{{ $titleLine1 }}</span>
                    <span class="block bg-gradient-to-r from-sky-300 via-blue-400 to-indigo-400 bg-clip-text text-transparent">
                        {{ $titleLine2 }}
                    </span>
                </h2>
                <p class="text-sm text-slate-300 sm:text-base">
                    Submit your application in under 10 minutes. Our admissions advisors will review your background,
                    share curriculum samples, and outline financing options that fit your plan.
                </p>
            </div>
            <div class="flex flex-col gap-4 md:justify-self-end">
                <x-public.button href="{{ $applyLink }}" class="justify-center px-6 py-3 text-sm">
                    {{ $applyText }}
                </x-public.button>
                <x-public.button href="{{ $contactLink }}" variant="secondary" class="justify-center px-6 py-3 text-sm">
                    {{ $contactText }}
                </x-public.button>
                <p class="text-center text-xs text-slate-400">
                    We accept instalments, employer sponsorship, and KIP Kuliah for eligible learners.
                </p>
            </div>
        </div>
    </div>
</section>
