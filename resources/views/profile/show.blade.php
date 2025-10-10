@php
    $user = Auth::user();
    $initials = collect(explode(' ', trim($user->name ?? '')))
        ->filter(fn ($part) => $part !== '')
        ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
        ->take(2)
        ->implode('');
@endphp

<x-app-layout>
    <section class="relative px-4 py-24 sm:py-28 lg:py-32">
        <div class="mx-auto max-w-6xl space-y-16">
            <div class="grid gap-10 lg:grid-cols-[1.1fr_0.9fr]">
                <div class="flex flex-col justify-between gap-10 rounded-[32px] border border-white/10 bg-white/5 p-8 shadow-[0_30px_120px_-40px_rgba(56,189,248,0.65)] backdrop-blur-xl sm:p-10">
                    <div class="space-y-5">
                        <span class="inline-flex w-fit items-center gap-2 rounded-full border border-white/10 bg-sky-500/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.32em] text-sky-200/80">
                            Account
                        </span>
                        <div class="space-y-3">
                            <h1 class="text-3xl font-semibold text-white sm:text-4xl">
                                Personalisasi akun kamu, {{ $user->name }}.
                            </h1>
                            <p class="text-base leading-relaxed text-slate-300/90">
                                Perbarui profil, amankan akses dengan autentikasi tambahan, dan kelola sesi aktif hanya dalam beberapa langkah. Semua perubahan tersinkron langsung dengan dashboard student kamu.
                            </p>
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-4">
                            <p class="text-sm font-semibold text-white">Email utama</p>
                            <p class="mt-2 text-sm text-slate-300/85">{{ $user->email }}</p>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-4">
                            <p class="text-sm font-semibold text-white">Terakhir login</p>
                            <p class="mt-2 text-sm text-slate-300/85">
                                {{ optional($user->last_login_at)->diffForHumans() ?? 'Baru saja' }}
                            </p>
                        </div>
                    </div>

                    <ul class="space-y-3 text-sm text-slate-300/80">
                        <li class="flex items-start gap-3">
                            <span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-300"></span>
                            Pastikan data kontakmu akurat agar pengumuman cohort selalu sampai.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-300"></span>
                            Aktifkan autentikasi dua langkah untuk perlindungan ekstra.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-300"></span>
                            Kelola perangkat aktif dan putuskan sesi mencurigakan secara langsung.
                        </li>
                    </ul>
                </div>

                <div class="relative">
                    <div class="absolute -inset-[2px] rounded-[36px] bg-gradient-to-br from-sky-500/40 via-indigo-500/30 to-blue-700/40 blur-2xl"></div>
                    <div class="relative flex flex-col gap-8 rounded-[32px] border border-white/10 bg-slate-950/80 p-8 shadow-[0_45px_120px_-50px_rgba(30,64,175,0.85)] backdrop-blur-2xl sm:p-10">
                        <div class="flex items-center gap-4">
                            <div class="flex h-16 w-16 items-center justify-center rounded-[1.75rem] bg-gradient-to-br from-indigo-500/70 to-sky-500/70 text-2xl font-semibold text-white">
                                {{ $initials ?: strtoupper(substr($user->email, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm uppercase tracking-[0.28em] text-slate-400/80">Student Account</p>
                                <h2 class="text-2xl font-semibold text-white">{{ $user->name }}</h2>
                            </div>
                        </div>

                        <div class="space-y-4 text-sm text-slate-300/85">
                            <div class="flex items-center justify-between rounded-2xl border border-white/10 bg-slate-900/60 px-4 py-3">
                                <span class="font-medium text-slate-200">Status akun</span>
                                <span class="inline-flex items-center gap-2 rounded-full bg-emerald-500/10 px-3 py-1 text-xs font-semibold text-emerald-200">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-300"></span>
                                    Aktif
                                </span>
                            </div>
                            <div class="rounded-2xl border border-white/10 bg-slate-900/60 px-4 py-3">
                                <p class="font-semibold text-slate-200">WhatsApp</p>
                                <p class="mt-1 text-slate-400">
                                    {{ $user->whatsapp_number ?? 'Belum ditambahkan' }}
                                </p>
                            </div>
                        </div>

                        <div class="rounded-2xl border border-white/10 bg-slate-900/60 p-4 text-sm text-slate-300/85">
                            <p>
                                Butuh bantuan? Hubungi support melalui
                                <a href="mailto:{{ config('mail.from.address', 'support@bootcamp.test') }}" class="font-semibold text-sky-200 hover:text-sky-100">
                                    {{ config('mail.from.address', 'support@bootcamp.test') }}
                                </a>
                                atau WhatsApp admin cohort.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-12">
                @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                    @livewire('profile.update-profile-information-form')
                @endif

                @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                    @livewire('profile.update-password-form')
                @endif

                @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                    @livewire('profile.two-factor-authentication-form')
                @endif

                @livewire('profile.logout-other-browser-sessions-form')

                @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                    @livewire('profile.delete-user-form')
                @endif
            </div>
        </div>
    </section>
</x-app-layout>
