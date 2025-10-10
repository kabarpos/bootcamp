@extends('layouts.public')

@section('content')
    <section class="relative px-4 py-24 sm:py-28 lg:py-32">
        <div class="mx-auto grid max-w-6xl gap-12 lg:grid-cols-[1.05fr_0.95fr]">
            <div class="flex flex-col justify-center gap-8 rounded-[32px] border border-white/10 bg-white/5 p-8 shadow-[0_30px_120px_-40px_rgba(14,165,233,0.7)] backdrop-blur-xl sm:p-10 lg:p-12">
                <span class="inline-flex w-fit items-center gap-2 rounded-full border border-white/10 bg-emerald-500/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.32em] text-emerald-200/80">
                    Join Cohort
                </span>
                <div class="space-y-4">
                    <h1 class="text-3xl font-semibold text-white sm:text-4xl">
                        Siap belajar langsung bersama praktisi unggulan.
                    </h1>
                    <p class="max-w-xl text-base leading-relaxed text-slate-300/90">
                        Daftar ke bootcamp pilihanmu, terhubung dengan mentor, dan bangun portofolio profesional. 
                        Seluruh kelas dirancang interaktif dan berbasis project nyata.
                    </p>
                </div>
                <div class="grid gap-6 sm:grid-cols-2">
                    <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-4">
                        <h3 class="text-sm font-semibold text-white">Mentoring Personalized</h3>
                        <p class="mt-2 text-sm text-slate-300/80">
                            1-on-1 sesi mentoring dan review tugas langsung dari mentor industri.
                        </p>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-4">
                        <h3 class="text-sm font-semibold text-white">Karier Support</h3>
                        <p class="mt-2 text-sm text-slate-300/80">
                            Dapatkan akses ke career coach, referensi hiring partner, dan komunitas alumni.
                        </p>
                    </div>
                </div>
                <ul class="grid gap-3 text-sm text-slate-300/80">
                    <li class="flex items-start gap-3">
                        <span class="mt-1 h-2 w-2 rounded-full bg-sky-300"></span>
                        Kelas live 3x seminggu dengan sesi Q&A langsung.
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 h-2 w-2 rounded-full bg-sky-300"></span>
                        Akses rekaman, template, dan resource eksklusif.
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-1 h-2 w-2 rounded-full bg-sky-300"></span>
                        Sertifikat kelulusan resmi siap dibagikan ke LinkedIn.
                    </li>
                </ul>
            </div>

            <div class="relative">
                <div class="absolute -inset-[2px] rounded-[36px] bg-gradient-to-br from-emerald-400/60 via-sky-500/40 to-indigo-600/50 blur-2xl"></div>
                <div class="relative rounded-[32px] border border-white/10 bg-slate-950/80 p-8 shadow-[0_45px_120px_-50px_rgba(30,64,175,0.85)] backdrop-blur-2xl sm:p-10">
                    <div class="mb-8 space-y-3 text-center">
                        <a href="{{ route('public.homepage') }}" class="inline-flex items-center justify-center gap-2 text-2xl font-semibold tracking-tight text-white transition hover:text-emerald-200">
                            <span>{{ config('app.name', 'Bootcamp') }}</span>
                        </a>
                        <div class="space-y-1">
                            <h2 class="text-2xl font-semibold text-white sm:text-3xl">Buat akun bootcamp kamu</h2>
                            <p class="text-sm text-slate-400">
                                Hanya butuh beberapa menit untuk bisa ikut cohort pilihanmu.
                            </p>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="mb-6 rounded-2xl border border-rose-500/40 bg-rose-500/10 px-4 py-4 text-sm text-rose-200">
                            <p class="font-semibold">Mohon periksa kembali:</p>
                            <ul class="mt-2 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li class="flex items-start gap-2">
                                        <span class="mt-1 h-1.5 w-1.5 rounded-full bg-rose-300"></span>
                                        <span>{{ $error }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" class="space-y-6">
                        @csrf

                        <div class="space-y-2">
                            <label for="name" class="text-sm font-semibold text-white">
                                Nama lengkap
                            </label>
                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                autocomplete="name"
                                class="block w-full rounded-2xl border border-white/10 bg-slate-900/70 px-4 py-3 text-sm text-white outline-none transition focus:border-emerald-400/70 focus:ring-2 focus:ring-emerald-500/40"
                            >
                        </div>

                        <div class="space-y-2">
                            <label for="email" class="text-sm font-semibold text-white">
                                Email
                            </label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                required
                                autocomplete="username"
                                class="block w-full rounded-2xl border border-white/10 bg-slate-900/70 px-4 py-3 text-sm text-white outline-none transition focus:border-emerald-400/70 focus:ring-2 focus:ring-emerald-500/40"
                            >
                        </div>

                        <div class="space-y-2">
                            <label for="whatsapp_number" class="text-sm font-semibold text-white">
                                Nomor WhatsApp
                            </label>
                            <input
                                id="whatsapp_number"
                                type="text"
                                name="whatsapp_number"
                                value="{{ old('whatsapp_number') }}"
                                required
                                inputmode="tel"
                                autocomplete="tel"
                                placeholder="+6281234567890"
                                class="block w-full rounded-2xl border border-white/10 bg-slate-900/70 px-4 py-3 text-sm text-white outline-none transition focus:border-emerald-400/70 focus:ring-2 focus:ring-emerald-500/40"
                            >
                        </div>

                        <div class="grid gap-6 sm:grid-cols-2">
                            <div class="space-y-2">
                                <label for="password" class="text-sm font-semibold text-white">
                                    Password
                                </label>
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                    class="block w-full rounded-2xl border border-white/10 bg-slate-900/70 px-4 py-3 text-sm text-white outline-none transition focus:border-emerald-400/70 focus:ring-2 focus:ring-emerald-500/40"
                                >
                            </div>
                            <div class="space-y-2">
                                <label for="password_confirmation" class="text-sm font-semibold text-white">
                                    Konfirmasi password
                                </label>
                                <input
                                    id="password_confirmation"
                                    type="password"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                    class="block w-full rounded-2xl border border-white/10 bg-slate-900/70 px-4 py-3 text-sm text-white outline-none transition focus:border-emerald-400/70 focus:ring-2 focus:ring-emerald-500/40"
                                >
                            </div>
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                            <div class="rounded-2xl border border-white/10 bg-slate-900/60 p-4 text-sm text-slate-300/80">
                                <label for="terms" class="flex items-start gap-3">
                                    <input
                                        id="terms"
                                        type="checkbox"
                                        name="terms"
                                        required
                                        class="mt-0.5 h-4 w-4 rounded border-white/10 bg-slate-950/80 text-emerald-400 focus:ring-emerald-500/40"
                                    >
                                    <span>
                                        {!! __('Saya setuju dengan :terms_of_service dan :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="font-semibold text-emerald-200 hover:text-emerald-100">'.__('Terms of Service').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="font-semibold text-emerald-200 hover:text-emerald-100">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </span>
                                </label>
                            </div>
                        @endif

                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-emerald-500 to-sky-500 px-5 py-3 text-sm font-semibold text-white shadow-[0_18px_45px_-20px_rgba(52,211,153,0.9)] transition hover:from-emerald-400 hover:to-sky-400 focus:outline-none focus:ring-2 focus:ring-emerald-300/60"
                        >
                            Daftar & Gabung Cohort
                        </button>
                    </form>

                    <p class="mt-8 text-center text-sm text-slate-400">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-semibold text-emerald-200 transition hover:text-emerald-100">
                            Masuk sekarang
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
