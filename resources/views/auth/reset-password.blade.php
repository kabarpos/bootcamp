@extends('layouts.public')

@section('content')
    <section class="relative px-4 py-24 sm:py-28 lg:py-32">
        <div class="mx-auto max-w-4xl">
            <div class="grid gap-8 lg:grid-cols-[0.9fr_1.1fr]">
                <div class="flex flex-col justify-center gap-8 rounded-[32px] border border-white/10 bg-white/5 p-8 shadow-[0_30px_120px_-40px_rgba(167,139,250,0.65)] backdrop-blur-xl sm:p-10">
                    <span class="inline-flex w-fit items-center gap-2 rounded-full border border-white/10 bg-indigo-500/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.32em] text-indigo-200/80">
                        Secure Reset
                    </span>
                    <div class="space-y-4">
                        <h1 class="text-3xl font-semibold text-white sm:text-4xl">
                            Buat password baru yang lebih kuat dan aman.
                        </h1>
                        <p class="text-base leading-relaxed text-slate-300/85">
                            Kami baru saja memverifikasi token reset kamu. Silakan isi password baru yang unik lalu konfirmasi untuk mengamankan akun bootcamp.
                        </p>
                    </div>
                    <ul class="space-y-3 text-sm text-slate-300/80">
                        <li class="flex items-start gap-3">
                            <span class="mt-1 h-1.5 w-1.5 rounded-full bg-indigo-300"></span>
                            Gunakan minimal 8 karakter dengan kombinasi huruf, angka, dan simbol.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-1 h-1.5 w-1.5 rounded-full bg-indigo-300"></span>
                            Hindari menggunakan kata sandi yang sama dengan platform lain.
                        </li>
                        <li class="flex items-start gap-3">
                            <span class="mt-1 h-1.5 w-1.5 rounded-full bg-indigo-300"></span>
                            Simpan password di password manager favoritmu.
                        </li>
                    </ul>
                </div>

                <div class="relative">
                    <div class="absolute -inset-[2px] rounded-[36px] bg-gradient-to-br from-indigo-500/60 via-sky-500/40 to-blue-700/50 blur-2xl"></div>
                    <div class="relative rounded-[32px] border border-white/10 bg-slate-950/80 p-8 shadow-[0_45px_120px_-50px_rgba(30,64,175,0.85)] backdrop-blur-2xl sm:p-10">
                        <div class="mb-8 space-y-3 text-center">
                            <a href="{{ route('public.homepage') }}" class="inline-flex items-center justify-center gap-2 text-2xl font-semibold tracking-tight text-white transition hover:text-indigo-200">
                                <span>{{ config('app.name', 'Bootcamp') }}</span>
                            </a>
                            <div class="space-y-1">
                                <h2 class="text-2xl font-semibold text-white sm:text-3xl">Atur ulang password kamu</h2>
                                <p class="text-sm text-slate-400">
                                    Masukkan password baru dan konfirmasi untuk menyelesaikan proses reset.
                                </p>
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="mb-6 rounded-2xl border border-rose-500/40 bg-rose-500/10 px-4 py-4 text-sm text-rose-200">
                                <p class="font-semibold">Ada yang perlu diperbaiki:</p>
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

                        <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                            @csrf

                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <div class="space-y-2">
                                <label for="email" class="text-sm font-semibold text-white">
                                    Email
                                </label>
                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email', $request->email) }}"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    class="block w-full rounded-2xl border border-white/10 bg-slate-900/70 px-4 py-3 text-sm text-white outline-none transition focus:border-indigo-400/70 focus:ring-2 focus:ring-indigo-500/40"
                                >
                            </div>

                            <div class="space-y-2">
                                <label for="password" class="text-sm font-semibold text-white">
                                    Password baru
                                </label>
                                <input
                                    id="password"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                    class="block w-full rounded-2xl border border-white/10 bg-slate-900/70 px-4 py-3 text-sm text-white outline-none transition focus:border-indigo-400/70 focus:ring-2 focus:ring-indigo-500/40"
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
                                    class="block w-full rounded-2xl border border-white/10 bg-slate-900/70 px-4 py-3 text-sm text-white outline-none transition focus:border-indigo-400/70 focus:ring-2 focus:ring-indigo-500/40"
                                >
                            </div>

                            <button
                                type="submit"
                                class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-indigo-500 to-sky-500 px-5 py-3 text-sm font-semibold text-white shadow-[0_18px_45px_-20px_rgba(129,140,248,0.9)] transition hover:from-indigo-400 hover:to-sky-400 focus:outline-none focus:ring-2 focus:ring-indigo-300/60"
                            >
                                Simpan password baru
                            </button>
                        </form>

                        <p class="mt-8 text-center text-sm text-slate-400">
                            Ingat password lama kamu?
                            <a href="{{ route('login') }}" class="font-semibold text-indigo-200 transition hover:text-indigo-100">
                                Kembali ke halaman login
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
