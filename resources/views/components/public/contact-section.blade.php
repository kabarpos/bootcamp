@php
    $subtitle = $subtitle ?? 'Talk to our team';
    $title = $title ?? 'Let’s map out your path into tech';
    $description = $description ?? 'Whether you are building your first skillset or levelling up an existing career, our advisors are here to help you choose the right program.';
@endphp

<section id="contact" class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_left,_rgba(56,189,248,0.12),_transparent_60%)]"></div>

    <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <x-public.section-title
            :subtitle="$subtitle"
            :title="$title"
            :description="$description"
        />

        <div class="mt-14 grid gap-10 lg:grid-cols-[0.65fr_0.35fr]">
            <form
                action="{{ $formAction ?? '#' }}"
                method="POST"
                class="glass-card relative overflow-hidden rounded-[32px] border border-white/10 p-8">
                @csrf
                <span class="spotlight-ring"></span>

                <div class="grid gap-6 md:grid-cols-2">
                    <div class="md:col-span-1">
                        <label for="name" class="mb-2 block text-xs font-semibold uppercase tracking-[0.28em] text-slate-400">Full name</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            autocomplete="name"
                            placeholder="{{ $namePlaceholder ?? 'Your full name' }}"
                            class="w-full rounded-2xl border border-white/10 bg-slate-900/60 px-4 py-3 text-sm text-slate-200 placeholder:text-slate-500 focus:border-sky-400 focus:outline-none focus:ring-2 focus:ring-sky-400/30"
                            required>
                    </div>
                    <div class="md:col-span-1">
                        <label for="email" class="mb-2 block text-xs font-semibold uppercase tracking-[0.28em] text-slate-400">Email</label>
                        <input
                            type="email"
                            name="email"
                            id="email"
                            autocomplete="email"
                            placeholder="{{ $emailPlaceholder ?? 'you@email.com' }}"
                            class="w-full rounded-2xl border border-white/10 bg-slate-900/60 px-4 py-3 text-sm text-slate-200 placeholder:text-slate-500 focus:border-sky-400 focus:outline-none focus:ring-2 focus:ring-sky-400/30"
                            required>
                    </div>
                    <div class="md:col-span-1">
                        <label for="phone" class="mb-2 block text-xs font-semibold uppercase tracking-[0.28em] text-slate-400">Whatsapp / phone</label>
                        <input
                            type="text"
                            name="phone"
                            id="phone"
                            autocomplete="tel"
                            placeholder="{{ $phonePlaceholder ?? '+62 81 1234 5678' }}"
                            class="w-full rounded-2xl border border-white/10 bg-slate-900/60 px-4 py-3 text-sm text-slate-200 placeholder:text-slate-500 focus:border-sky-400 focus:outline-none focus:ring-2 focus:ring-sky-400/30">
                    </div>
                    <div class="md:col-span-1">
                        <label for="goal" class="mb-2 block text-xs font-semibold uppercase tracking-[0.28em] text-slate-400">Learning goal</label>
                        <select
                            id="goal"
                            name="goal"
                            class="w-full rounded-2xl border border-white/10 bg-slate-900/60 px-4 py-3 text-sm text-slate-200 focus:border-sky-400 focus:outline-none focus:ring-2 focus:ring-sky-400/30">
                            <option value="">Select your focus</option>
                            <option>Career switch</option>
                            <option>Skill upgrade</option>
                            <option>Startup builder</option>
                            <option>Corporate training</option>
                        </select>
                    </div>
                    <div class="md:col-span-2">
                        <label for="message" class="mb-2 block text-xs font-semibold uppercase tracking-[0.28em] text-slate-400">How can we help?</label>
                        <textarea
                            id="message"
                            name="message"
                            rows="4"
                            placeholder="{{ $messagePlaceholder ?? 'Tell us about your journey so far and what success looks like.' }}"
                            class="w-full rounded-2xl border border-white/10 bg-slate-900/60 px-4 py-3 text-sm text-slate-200 placeholder:text-slate-500 focus:border-sky-400 focus:outline-none focus:ring-2 focus:ring-sky-400/30"
                            required></textarea>
                    </div>
                </div>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                    <p class="text-xs text-slate-400">
                        We reply within 24 hours Monday–Friday. Prefer instant support? Chat with us on
                        <a href="https://wa.me/62811888000" target="_blank" rel="noopener" class="text-sky-300 hover:text-sky-200">WhatsApp</a>.
                    </p>
                    <x-public.button type="submit" class="justify-center px-6 py-3 text-sm">
                        {{ $submitText ?? 'Send message' }}
                    </x-public.button>
                </div>
            </form>

            <aside class="glass-card relative overflow-hidden rounded-[32px] border border-white/10 p-8">
                <span class="spotlight-ring"></span>
                <div class="relative flex h-full flex-col gap-8">
                    <div>
                        <h3 class="text-lg font-semibold text-white">{{ $infoTitle ?? 'Admissions desk' }}</h3>
                        <p class="mt-3 text-sm text-slate-300">
                            {{ $infoDescription ?? 'Our team of program advisors is ready to guide you on financing, curriculum fit, and cohort timelines.' }}
                        </p>
                    </div>
                    <div class="space-y-5 text-sm text-slate-200">
                        <div class="flex gap-3">
                            <span class="mt-1 flex h-9 w-9 items-center justify-center rounded-2xl bg-sky-500/10 text-sky-300">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                                    <path d="M3 5.5A2.5 2.5 0 015.5 3h1.172a1.5 1.5 0 011.414 1.057l1.26 4.201a1.5 1.5 0 01-.863 1.807l-1.08.405a11.04 11.04 0 005.675 5.675l.405-1.08a1.5 1.5 0 011.807-.863l4.201 1.26A1.5 1.5 0 0121 17.328V18.5A2.5 2.5 0 0118.5 21H17C9.82 21 4 15.18 4 8V6.5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <div>
                                <p class="font-semibold text-white">{{ $phone ?? '+62 811-888-000' }}</p>
                                <p class="text-xs uppercase tracking-[0.26em] text-slate-400">{{ $phoneHours ?? 'Mon–Fri · 09.00 – 18.00 WIB' }}</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <span class="mt-1 flex h-9 w-9 items-center justify-center rounded-2xl bg-indigo-500/10 text-indigo-300">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                                    <path d="M4 6.75A2.75 2.75 0 016.75 4h10.5A2.75 2.75 0 0120 6.75V17.25A2.75 2.75 0 0117.25 20H6.75A2.75 2.75 0 014 17.25V6.75z" stroke="currentColor" stroke-width="1.6" />
                                    <path d="M4 7l8 5 8-5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <div>
                                <p class="font-semibold text-white">{{ $email ?? 'admissions@novatechcamp.com' }}</p>
                                <p class="text-xs uppercase tracking-[0.26em] text-slate-400">We reply within 24 hours</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <span class="mt-1 flex h-9 w-9 items-center justify-center rounded-2xl bg-emerald-500/10 text-emerald-300">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none">
                                    <path d="M12 21s6.75-5.097 6.75-9.75a6.75 6.75 0 10-13.5 0C5.25 15.903 12 21 12 21z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" />
                                    <circle cx="12" cy="11.25" r="2.25" stroke="currentColor" stroke-width="1.6" />
                                </svg>
                            </span>
                            <div>
                                <p class="font-semibold text-white">{{ $addressLine1 ?? 'Menara Astra 25F' }}</p>
                                <p class="text-xs uppercase tracking-[0.26em] text-slate-400">{{ $addressLine2 ?? 'Central Jakarta, Indonesia' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-auto rounded-2xl border border-white/10 bg-slate-900/50 p-4 text-xs text-slate-400">
                        Looking for team-wide adoption? Ask us about custom corporate cohorts and on-site training packages.
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>
