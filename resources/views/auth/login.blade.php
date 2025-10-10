@extends('layouts.public')

@section('content')
    <section class="relative px-4 py-24 sm:py-28 lg:py-32">
        <div class="mx-auto grid max-w-6xl gap-12 lg:grid-cols-[1.1fr_0.9fr]">
            <div class="flex flex-col justify-center gap-10 rounded-[32px] border border-white/10 bg-white/5 p-8 shadow-[0_30px_120px_-40px_rgba(14,165,233,0.7)] backdrop-blur-xl sm:p-10 lg:p-12">
                <span class="inline-flex w-fit items-center gap-2 rounded-full border border-white/10 bg-slate-950/30 px-4 py-2 text-xs font-semibold uppercase tracking-[0.32em] text-sky-200/80">
                    Access
                </span>
                <div class="space-y-4">
                    <h1 class="text-3xl font-semibold text-white sm:text-4xl">
                        Selamat datang kembali, builder inovatif!
                    </h1>
                    <p class="max-w-xl text-base leading-relaxed text-slate-300/90">
                        Masuk untuk melanjutkan perjalanan belajar, cek progress cohort, dan ikuti sesi live tanpa ketinggalan. 
                        Dashboard kamu sudah menunggu dengan insight terbaru dari mentor.
                    </p>
                </div>
                <dl class="grid gap-6 sm:grid-cols-2">
                    <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-4">
                        <dt class="flex items-center gap-2 text-sm font-semibold text-white">
                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-sky-500/20 text-sky-300">1</span>
                            Update Bootcamp
                        </dt>
                        <dd class="mt-2 text-sm text-slate-300/80">
                            Lihat materi terbaru, jadwal live, dan pengumuman penting langsung dari tim mentor.
                        </dd>
                    </div>
                    <div class="rounded-2xl border border-white/10 bg-slate-950/40 p-4">
                        <dt class="flex items-center gap-2 text-sm font-semibold text-white">
                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-500/20 text-emerald-300">2</span>
                            Progres & Sertifikat
                        </dt>
                        <dd class="mt-2 text-sm text-slate-300/80">
                            Pantau capaian tugas, submit project akhir, dan siapkan diri untuk sertifikasi.
                        </dd>
                    </div>
                </dl>
            </div>

            <div class="relative">
                <div class="absolute -inset-[2px] rounded-[36px] bg-gradient-to-br from-sky-500/60 via-indigo-500/40 to-blue-700/50 blur-2xl"></div>
                <div class="relative rounded-[32px] border border-white/10 bg-slate-950/80 p-8 shadow-[0_45px_120px_-50px_rgba(30,64,175,0.85)] backdrop-blur-2xl sm:p-10">
                    <div class="mb-8 space-y-3 text-center">
                        <a href="{{ route('public.homepage') }}" class="inline-flex items-center justify-center gap-2 text-2xl font-semibold tracking-tight text-white transition hover:text-sky-200">
                            <span>{{ config('app.name', 'Bootcamp') }}</span>
                        </a>
                        <div class="space-y-1">
                            <h2 class="text-2xl font-semibold text-white sm:text-3xl">Masuk ke akun kamu</h2>
                            <p class="text-sm text-slate-400">
                                Gunakan email dan kata sandi yang terdaftar di bootcamp.
                            </p>
                        </div>
                    </div>

                    @if (session('status'))
                        <div class="mb-6 rounded-2xl border border-emerald-500/40 bg-emerald-500/10 px-4 py-3 text-sm font-medium text-emerald-200">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 rounded-2xl border border-rose-500/40 bg-rose-500/10 px-4 py-4 text-sm text-rose-200">
                            <p class="font-semibold">Periksa kembali:</p>
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

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf

                        <div class="space-y-2">
                            <label for="email" class="text-sm font-semibold text-white">
                                Email
                            </label>
                            <div class="relative">
                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    class="block w-full rounded-2xl border border-white/10 bg-slate-900/70 px-4 py-3 text-sm text-white outline-none ring-0 transition focus:border-sky-400/70 focus:ring-2 focus:ring-sky-500/40"
                                >
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <label for="password" class="text-sm font-semibold text-white">
                                    Password
                                </label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-sm font-medium text-sky-300 transition hover:text-sky-200">
                                        Lupa password?
                                    </a>
                                @endif
                            </div>
                            <input
                                id="password"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                                class="block w-full rounded-2xl border border-white/10 bg-slate-900/70 px-4 py-3 text-sm text-white outline-none transition focus:border-sky-400/70 focus:ring-2 focus:ring-sky-500/40"
                            >
                        </div>

                        <div class="flex items-center justify-between">
                            <label for="remember" class="inline-flex items-center gap-3 text-sm text-slate-300/80">
                                <input
                                    id="remember"
                                    type="checkbox"
                                    name="remember"
                                    class="h-4 w-4 rounded border-white/10 bg-slate-900/70 text-sky-400 focus:ring-sky-400/50"
                                >
                                <span>Ingat saya di perangkat ini</span>
                            </label>
                        </div>

                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-sky-500 to-indigo-500 px-5 py-3 text-sm font-semibold text-white shadow-[0_18px_45px_-20px_rgba(56,189,248,0.95)] transition hover:from-sky-400 hover:to-indigo-400 focus:outline-none focus:ring-2 focus:ring-sky-300/60"
                        >
                            Masuk sekarang
                        </button>
                    </form>

                    <p class="mt-8 text-center text-sm text-slate-400">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="font-semibold text-sky-300 transition hover:text-sky-200">
                            Daftar bootcamp
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
