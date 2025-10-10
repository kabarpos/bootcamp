@extends('layouts.public')

@section('content')
    <section class="relative px-4 py-24 sm:py-28 lg:py-32">
        <div class="mx-auto max-w-4xl">
            <div class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr]">
                <div class="flex flex-col justify-center gap-8 rounded-[32px] border border-white/10 bg-white/5 p-8 shadow-[0_30px_120px_-40px_rgba(56,189,248,0.65)] backdrop-blur-xl sm:p-10">
                    <span class="inline-flex w-fit items-center gap-2 rounded-full border border-white/10 bg-sky-500/10 px-4 py-2 text-xs font-semibold uppercase tracking-[0.32em] text-sky-200/80">
                        Reset Access
                    </span>
                    <div class="space-y-4">
                        <h1 class="text-3xl font-semibold text-white sm:text-4xl">
                            Lupa password? Kami bantu pulihkan akses kamu.
                        </h1>
                        <p class="text-base leading-relaxed text-slate-300/85">
                            Masukkan email yang kamu gunakan saat mendaftar bootcamp. Kami akan kirimkan tautan reset agar kamu bisa membuat password baru yang lebih kuat.
                        </p>
                    </div>
                    <div class="grid gap-4 text-sm text-slate-300/80">
                        <div class="rounded-2xl border border-white/10 bg-slate-950/45 p-4">
                            <h3 class="font-semibold text-white">Tips keamanan akun</h3>
                            <ul class="mt-3 space-y-2">
                                <li class="flex items-start gap-3">
                                    <span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-300"></span>
                                    Gunakan kombinasi huruf besar, huruf kecil, angka, dan simbol unik.
                                </li>
                                <li class="flex items-start gap-3">
                                    <span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-300"></span>
                                    Jangan gunakan password yang sama dengan akun lain.
                                </li>
                                <li class="flex items-start gap-3">
                                    <span class="mt-1 h-1.5 w-1.5 rounded-full bg-sky-300"></span>
                                    Update password secara berkala untuk meminimalkan risiko.
                                </li>
                            </ul>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-slate-950/45 p-4 leading-relaxed">
                            <p>
                                Masih butuh bantuan? Hubungi tim support melalui 
                                <a href="mailto:{{ config('mail.from.address', 'support@bootcamp.test') }}" class="font-semibold text-sky-200 hover:text-sky-100">
                                    {{ config('mail.from.address', 'support@bootcamp.test') }}
                                </a>
                                atau WhatsApp admin cohort.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="relative">
                    <div class="absolute -inset-[2px] rounded-[36px] bg-gradient-to-br from-sky-500/60 via-indigo-500/40 to-blue-700/50 blur-2xl"></div>
                    <div class="relative rounded-[32px] border border-white/10 bg-slate-950/80 p-8 shadow-[0_45px_120px_-50px_rgba(30,64,175,0.85)] backdrop-blur-2xl sm:p-10">
                        <div class="mb-8 space-y-3 text-center">
                            <a href="{{ route('public.homepage') }}" class="inline-flex items-center justify-center gap-2 text-2xl font-semibold tracking-tight text-white transition hover:text-sky-200">
                                <span>{{ config('app.name', 'Bootcamp') }}</span>
                            </a>
                            <div class="space-y-1">
                                <h2 class="text-2xl font-semibold text-white sm:text-3xl">Kirim tautan reset password</h2>
                                <p class="text-sm text-slate-400">
                                    Kami akan mengirim email berisi langkah-langkah untuk membuat password baru.
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
                                <p class="font-semibold">Mohon koreksi:</p>
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

                        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                            @csrf

                            <div class="space-y-2">
                                <label for="email" class="text-sm font-semibold text-white">
                                    Email terdaftar
                                </label>
                                <input
                                    id="email"
                                    type="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    class="block w-full rounded-2xl border border-white/10 bg-slate-900/70 px-4 py-3 text-sm text-white outline-none transition focus:border-sky-400/70 focus:ring-2 focus:ring-sky-500/40"
                                >
                            </div>

                            <button
                                type="submit"
                                class="inline-flex w-full items-center justify-center gap-2 rounded-2xl bg-gradient-to-r from-sky-500 to-indigo-500 px-5 py-3 text-sm font-semibold text-white shadow-[0_18px_45px_-20px_rgba(56,189,248,0.95)] transition hover:from-sky-400 hover:to-indigo-400 focus:outline-none focus:ring-2 focus:ring-sky-300/60"
                            >
                                Kirim tautan reset
                            </button>
                        </form>

                        <p class="mt-8 text-center text-sm text-slate-400">
                            Ingat password kamu?
                            <a href="{{ route('login') }}" class="font-semibold text-sky-200 transition hover:text-sky-100">
                                Kembali ke halaman login
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
