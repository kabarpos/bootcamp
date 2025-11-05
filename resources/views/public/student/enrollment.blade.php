@extends('layouts.public')

@section('content')
@php
    $badgePalette = [
        'pending' => 'border border-amber-400/40 bg-amber-500/15 text-amber-200',
        'confirmed' => 'border border-sky-400/40 bg-sky-500/15 text-sky-200',
        'completed' => 'border border-emerald-400/40 bg-emerald-500/15 text-emerald-200',
        'cancelled' => 'border border-rose-500/40 bg-rose-500/15 text-rose-200',
        'paid' => 'border border-emerald-400/40 bg-emerald-500/15 text-emerald-200',
        'expired' => 'border border-orange-400/40 bg-orange-500/15 text-orange-200',
        'failed' => 'border border-rose-500/40 bg-rose-500/15 text-rose-200',
        'refunded' => 'border border-purple-400/40 bg-purple-500/15 text-purple-200',
    ];

    $enrollmentBadgeClass = $badgePalette[$enrollmentMeta['value'] ?? 'pending'] ?? $badgePalette['pending'];
    $paymentBadgeClass = $badgePalette[$paymentMeta['value'] ?? 'pending'] ?? $badgePalette['pending'];
@endphp

<section class="relative px-4 py-24 sm:py-28 lg:py-32">
    <div class="mx-auto max-w-5xl space-y-10">
        <a href="{{ route('public.dashboard') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-slate-300/80 transition hover:text-white">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke dashboard
        </a>

        <div class="relative overflow-hidden rounded-[32px] border border-white/10 bg-slate-950/80 p-8 shadow-[0_40px_120px_-50px_rgba(14,165,233,0.65)] backdrop-blur-2xl sm:p-10">
            <div class="flex flex-col gap-8 lg:flex-row lg:items-start lg:justify-between">
                <div class="space-y-5">
                    <div class="space-y-2">
                        <p class="text-xs uppercase tracking-[0.38em] text-slate-400/80">Bootcamp detail</p>
                        <h1 class="text-3xl font-semibold text-white sm:text-4xl">
                            {{ optional($bootcamp)->title ?? 'Bootcamp' }}
                        </h1>
                        <p class="text-sm font-medium text-slate-400">
                            Batch {{ optional($batch)->code ?? 'Tanpa kode' }}
                        </p>
                    </div>

                    <dl class="grid gap-4 sm:grid-cols-2">
                        <div class="rounded-2xl border border-white/10 bg-slate-900/60 p-4 text-sm text-slate-300/85">
                            <dt class="flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400/70">
                                <svg class="h-4 w-4 text-sky-300" fill="none" stroke="currentColor" stroke-width="1.4" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10m-12 8h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Jadwal
                            </dt>
                            <dd class="mt-2 text-sm leading-relaxed text-slate-200">
                                {{ $schedule['date_range'] ?? 'Menunggu konfirmasi' }}<br>
                                <span class="text-slate-400">{{ $schedule['time_range'] ?? 'Waktu menyusul' }}</span>
                            </dd>
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-slate-900/60 p-4 text-sm text-slate-300/85">
                            <dt class="flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.2em] text-slate-400/70">
                                <svg class="h-4 w-4 text-emerald-300" fill="none" stroke="currentColor" stroke-width="1.4" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 2a9 9 0 00-9 9v6a3 3 0 003 3h2a3 3 0 006 0h2a3 3 0 003-3v-6a9 9 0 00-9-9z" />
                                </svg>
                                Mode belajar
                            </dt>
                            <dd class="mt-2 text-sm leading-relaxed text-slate-200">
                                {{ $location['mode_label'] ?? 'Menunggu info' }}
                                @if ($location['city'])
                                    <span class="block text-slate-400">Lokasi: {{ $location['city'] }}</span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="flex flex-col items-start gap-4 lg:items-end">
                    <div class="flex flex-wrap gap-2">
                        <span class="inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-xs font-semibold {{ $enrollmentBadgeClass }}">
                            {{ $enrollmentMeta['label'] }}
                        </span>
                        <span class="inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-xs font-semibold {{ $paymentBadgeClass }}">
                            {{ $paymentMeta['label'] }}
                        </span>
                    </div>

                    @if($checkoutUrl)
                        <a href="{{ $checkoutUrl }}" class="inline-flex items-center gap-2 rounded-2xl bg-gradient-to-r from-sky-500 to-indigo-500 px-5 py-2.5 text-sm font-semibold text-white shadow-[0_18px_45px_-20px_rgba(56,189,248,0.95)] transition hover:from-sky-400 hover:to-indigo-400">
                            Lanjutkan pembayaran
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0L15 6m4.5 6L15 18" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid gap-8 lg:grid-cols-[1.6fr_1fr]">
            <div class="space-y-8">
                <section class="rounded-[28px] border border-white/10 bg-slate-950/70 p-6 backdrop-blur-2xl sm:p-8">
                    <div class="flex items-center justify-between gap-4">
                        <h2 class="text-lg font-semibold text-white">Jadwal Bootcamp</h2>
                        @if($schedule['start_date'])
                            <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-slate-900/60 px-3 py-1 text-xs font-semibold text-slate-200">
                                Mulai {{ $schedule['start_date'] }}
                            </span>
                        @endif
                    </div>
                    <div class="mt-6 space-y-4 text-sm text-slate-300/90">
                        <div class="flex gap-3">
                            <div class="mt-1 h-2 w-2 rounded-full bg-sky-300"></div>
                            <div>
                                <p class="font-semibold text-slate-200">Rentang tanggal</p>
                                <p>{{ $schedule['date_range'] ?? 'Jadwal akan diinformasikan oleh admin.' }}</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="mt-1 h-2 w-2 rounded-full bg-sky-300"></div>
                            <div>
                                <p class="font-semibold text-slate-200">Rentang waktu</p>
                                <p>{{ $schedule['time_range'] ?? 'Waktu akan diinformasikan menyusul.' }}</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="mt-1 h-2 w-2 rounded-full bg-sky-300"></div>
                            <div>
                                <p class="font-semibold text-slate-200">Catatan</p>
                                <p>Kehadiran di setiap sesi sangat disarankan. Rekaman akan dibagikan maksimal 24 jam setelah kelas selesai.</p>
                            </div>
                        </div>
                    </div>
                </section>

                @if($recordings->isNotEmpty())
                    <section class="rounded-[28px] border border-white/10 bg-slate-950/70 p-6 backdrop-blur-2xl sm:p-8">
                        <div class="flex items-center justify-between gap-4">
                            <h2 class="text-lg font-semibold text-white">Rekaman sesi</h2>
                            <span class="text-xs font-semibold uppercase tracking-[0.28em] text-slate-400/80">
                                {{ $recordings->count() }} video
                            </span>
                        </div>
                        <p class="mt-2 text-sm text-slate-300/85">
                            Tonton ulang sesi live yang sudah berlangsung. Tautan bersifat pribadi dan hanya bisa diakses oleh peserta batch ini.
                        </p>

                        <div class="mt-6 space-y-6">
                            @foreach($recordings as $recording)
                                <article class="rounded-2xl border border-white/10 bg-slate-900/50 p-4 sm:p-6">
                                    <div class="grid gap-4 lg:grid-cols-[1.2fr_0.8fr]">
                                        <div class="space-y-3">
                                            <div class="flex items-center gap-3 text-xs text-slate-400">
                                                @if($recording->recorded_at)
                                                    <span class="inline-flex items-center gap-2 rounded-full border border-white/10 px-3 py-1 font-semibold text-slate-200">
                                                        {{ $recording->recorded_at->format('d M Y H:i') }} WIB
                                                    </span>
                                                @endif
                                                <span class="uppercase tracking-[0.28em] text-slate-500">Video</span>
                                            </div>
                                            <h3 class="text-xl font-semibold text-white">
                                                {{ $recording->title }}
                                            </h3>
                                            @if($recording->description)
                                                <p class="text-sm leading-relaxed text-slate-300/85">
                                                    {{ $recording->description }}
                                                </p>
                                            @endif
                                            <div class="flex flex-wrap gap-3">
                                                <a href="{{ $recording->youtube_url }}" target="_blank" rel="noopener"
                                                   class="inline-flex items-center gap-2 rounded-2xl border border-white/15 px-4 py-2 text-sm font-semibold text-slate-200 transition hover:border-sky-400/40 hover:text-white">
                                                    Buka di YouTube
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H9.75m9.75 0V14.25" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="space-y-3">
                                            @if($recording->youtube_id)
                                                <div class="relative overflow-hidden rounded-2xl border border-white/10 bg-black/60 shadow-[0_25px_60px_-35px_rgba(56,189,248,0.55)]">
                                                    <div class="aspect-video">
                                                        <iframe
                                                            class="h-full w-full rounded-2xl"
                                                            src="{{ $recording->embed_url }}?rel=0"
                                                            title="{{ $recording->title }}"
                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                            allowfullscreen
                                                            loading="lazy"
                                                        ></iframe>
                                                    </div>
                                                </div>
                                            @elseif($recording->thumbnail_url)
                                                <img src="{{ $recording->thumbnail_url }}" alt="{{ $recording->title }}" class="w-full rounded-2xl border border-white/10 object-cover">
                                            @endif
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    </section>
                @endif

                <section class="rounded-[28px] border border-white/10 bg-slate-950/70 p-6 backdrop-blur-2xl sm:p-8">
                    <h2 class="text-lg font-semibold text-white">Lokasi &amp; akses</h2>
                    <div class="mt-6 space-y-5 text-sm text-slate-300/90">
                        <div>
                            <p class="font-semibold text-slate-200">Mode belajar</p>
                            <p>{{ $location['mode_label'] ?? 'Menunggu konfirmasi' }}</p>
                        </div>

                        @if($location['meeting_platform'] || $location['meeting_link'])
                            <div class="space-y-1">
                                <p class="font-semibold text-slate-200">Platform meeting</p>
                                <p>{{ $location['meeting_platform'] ?? 'Menunggu informasi' }}</p>
                                @if($location['meeting_link'])
                                    <a href="{{ $location['meeting_link'] }}" target="_blank" class="inline-flex items-center gap-2 text-sm font-semibold text-sky-200 transition hover:text-sky-100 cursor-pointer">
                                        Buka link meeting
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H9.75m9.75 0V14.25" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        @endif

                        @if($location['venue_name'] || $location['venue_address'])
                            <div class="space-y-1">
                                <p class="font-semibold text-slate-200">Lokasi venue</p>
                                <p>{{ $location['venue_name'] ?? 'Menunggu informasi venue' }}</p>
                                <p class="text-slate-400">{{ $location['venue_address'] ?? '' }}</p>
                                @if($location['map_link'])
                                    <a href="{{ $location['map_link'] }}" target="_blank" class="inline-flex items-center gap-2 text-sm font-semibold text-sky-200 transition hover:text-sky-100">
                                        Buka peta
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 20l-5.447-2.724A2 2 0 013 15.447V5.118a1 1 0 011.447-.894L9 6.5l6-3 5.553 2.776A2 2 0 0121 8.553V18.882a1 1 0 01-1.447.894L15 17.5l-6 3z" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        @endif

                        @if(!$location['meeting_link'] && !$location['venue_name'] && !$location['venue_address'])
                            <p>Detail lokasi atau meeting akan diinformasikan oleh admin sebelum kelas dimulai.</p>
                        @endif
                    </div>
                </section>

                @if($resourcesUrl)
                    <section class="rounded-[28px] border border-white/10 bg-slate-950/70 p-6 backdrop-blur-2xl sm:p-8">
                        <h2 class="text-lg font-semibold text-white">Materi &amp; sumber belajar</h2>
                        <p class="mt-2 text-sm text-slate-300/85">Kumpulan materi, template, dan referensi yang akan diperbarui sepanjang program.</p>
                        <a href="{{ $resourcesUrl }}" class="mt-5 inline-flex items-center gap-2 rounded-2xl border border-white/15 px-5 py-2.5 text-sm font-semibold text-slate-200 transition hover:border-sky-400/40 hover:text-white cursor-pointer">
                            Buka halaman materi
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.6" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                        </a>
                    </section>
                @endif
            </div>

            <aside class="space-y-8">
                <section class="rounded-[28px] border border-white/10 bg-slate-950/70 p-6 backdrop-blur-2xl sm:p-8">
                    <h2 class="text-lg font-semibold text-white">Status pembayaran</h2>
                    <div class="mt-6 space-y-4 text-sm text-slate-300/90">
                        @if($latestOrder)
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-slate-400">Invoice</span>
                                <span class="font-semibold text-slate-200">{{ $latestOrder->invoice_no }}</span>
                            </div>
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-slate-400">Jumlah</span>
                                <span class="font-semibold text-slate-200">Rp {{ number_format($latestOrder->total, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-slate-400">Status</span>
                                <span class="font-semibold text-slate-200">{{ $paymentMeta['label'] }}</span>
                            </div>
                            @php
                                $expiredAt = $latestOrder && $latestOrder->expired_at
                                    ? \Carbon\Carbon::parse($latestOrder->expired_at)
                                    : null;
                            @endphp
                            @if($latestOrder->status === 'pending' && $expiredAt)
                                <div class="flex items-center justify-between gap-3">
                                    <span class="text-slate-400">Batas bayar</span>
                                    <span class="font-semibold text-amber-200">{{ $expiredAt->format('d M Y H:i') }}</span>
                                </div>
                            @endif
                            @if($latestPayment)
                                @php
                                    $paidAt = $latestPayment && $latestPayment->paid_at
                                        ? \Carbon\Carbon::parse($latestPayment->paid_at)
                                        : null;
                                @endphp
                                <div>
                                    <p class="text-slate-400">Metode terakhir</p>
                                    <p class="font-semibold text-slate-200 capitalize">{{ $latestPayment->method ?? '-' }}</p>
                                    @if($paidAt)
                                        <p class="text-xs text-slate-400/70">Dibayar {{ $paidAt->format('d M Y H:i') }}</p>
                                    @endif
                                </div>
                            @endif
                        @else
                            <p>Belum ada informasi pembayaran untuk enrollment ini.</p>
                        @endif
                    </div>
                </section>

                <section class="rounded-[28px] border border-white/10 bg-slate-950/70 p-6 text-sm text-slate-300/90 backdrop-blur-2xl sm:p-8">
                    <h2 class="text-lg font-semibold text-white">Butuh bantuan?</h2>
                    <p class="mt-3 leading-relaxed">
                        Tim admin siap membantu melalui email
                        <a href="mailto:support@bootcamp.com" class="font-semibold text-sky-200 transition hover:text-sky-100">
                            support@bootcamp.com
                        </a>
                        atau WhatsApp resmi. Jangan ragu untuk menghubungi jika ada kendala kehadiran atau pembayaran.
                    </p>
                </section>
            </aside>
        </div>
    </div>
</section>
@endsection
