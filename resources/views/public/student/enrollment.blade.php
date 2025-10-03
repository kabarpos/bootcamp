@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-background py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('public.dashboard') }}"
           class="inline-flex items-center text-sm text-muted-foreground hover:text-primary transition">
            <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Dashboard
        </a>

        <div class="mt-6 rounded-xl border border-border bg-card shadow-sm">
            <div class="flex flex-col gap-4 p-6 md:flex-row md:items-start md:justify-between">
                <div>
                    <h1 class="text-2xl font-semibold text-foreground">{{ optional($bootcamp)->title ?? 'Bootcamp' }}</h1>
                    <p class="mt-1 text-sm text-muted-foreground">Batch {{ optional($batch)->code ?? 'Tanpa kode' }}</p>
                    @if($schedule['date_range'] || $schedule['time_range'])
                        <div class="mt-4 flex flex-wrap gap-4 text-sm text-muted-foreground">
                            @if($schedule['date_range'])
                                <span class="inline-flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10m-12 8h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ $schedule['date_range'] }}
                                </span>
                            @endif
                            @if($schedule['time_range'])
                                <span class="inline-flex items-center gap-2">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $schedule['time_range'] }}
                                </span>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="flex flex-col items-end gap-3">
                    <div class="flex flex-wrap justify-end gap-2">
                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $enrollmentMeta['badge'] }}">
                            {{ $enrollmentMeta['label'] }}
                        </span>
                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $paymentMeta['badge'] }}">
                            {{ $paymentMeta['label'] }}
                        </span>
                    </div>
                    @if($checkoutUrl)
                        <a href="{{ $checkoutUrl }}"
                           class="inline-flex items-center rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-primary-foreground hover:bg-primary/90 transition">
                            Lanjutkan Pembayaran
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-3">
            <div class="space-y-6 lg:col-span-2">
                <div class="rounded-xl border border-border bg-card shadow-sm">
                    <div class="border-b border-border px-6 py-4">
                        <h2 class="text-lg font-semibold text-foreground">Jadwal Bootcamp</h2>
                    </div>
                    <div class="space-y-4 p-6 text-sm text-muted-foreground">
                        <div class="flex items-start gap-3">
                            <svg class="mt-0.5 h-5 w-5 text-primary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10m-12 8h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <p class="text-foreground font-semibold">Rentang Tanggal</p>
                                <p>{{ $schedule['date_range'] ?? 'Jadwal akan diinformasikan' }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="mt-0.5 h-5 w-5 text-primary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="text-foreground font-semibold">Waktu Belajar</p>
                                <p>{{ $schedule['time_range'] ?? 'Menunggu konfirmasi' }}</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3">
                            <svg class="mt-0.5 h-5 w-5 text-primary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <p class="text-foreground font-semibold">Mode Belajar</p>
                                <p>{{ $location['mode_label'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-xl border border-border bg-card shadow-sm">
                    <div class="border-b border-border px-6 py-4">
                        <h2 class="text-lg font-semibold text-foreground">Informasi Lokasi / Meeting</h2>
                    </div>
                    <div class="space-y-4 p-6 text-sm text-muted-foreground">
                        @if($location['meeting_link'])
                            <div class="flex items-start gap-3">
                                <svg class="mt-0.5 h-5 w-5 text-primary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h8a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V8a2 2 0 012-2z" />
                                </svg>
                                <div>
                                    <p class="text-foreground font-semibold">Tautan Meeting</p>
                                    <p>{{ $location['meeting_platform'] ?? 'Online Meeting' }}</p>
                                    <a href="{{ $location['meeting_link'] }}" target="_blank"
                                       class="mt-1 inline-flex items-center text-sm font-medium text-primary hover:underline">
                                        Buka tautan
                                    </a>
                                </div>
                            </div>
                        @endif

                        @if($location['venue_name'] || $location['venue_address'])
                            <div class="flex items-start gap-3">
                                <svg class="mt-0.5 h-5 w-5 text-primary" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c1.657 0 3-1.567 3-3.5S13.657 4 12 4 9 5.567 9 7.5 10.343 11 12 11z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4.5 8-12a8 8 0 10-16 0c0 7.5 8 12 8 12z" />
                                </svg>
                                <div>
                                    <p class="text-foreground font-semibold">Lokasi</p>
                                    <p>{{ $location['venue_name'] ?? 'Venue belum ditentukan' }}</p>
                                    <p>{{ $location['venue_address'] ?? ($location['city'] ?? '') }}</p>
                                    @if($location['map_link'])
                                        <a href="{{ $location['map_link'] }}" target="_blank"
                                           class="mt-1 inline-flex items-center text-sm font-medium text-primary hover:underline">
                                            Buka peta
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endif

                        @if(!$location['meeting_link'] && !$location['venue_name'] && !$location['venue_address'])
                            <p class="text-sm text-muted-foreground">Detail lokasi atau meeting akan diinformasikan oleh admin.</p>
                        @endif
                    </div>
                </div>

                @if($resourcesUrl)
                    <div class="rounded-xl border border-border bg-card shadow-sm p-6">
                        <h2 class="text-lg font-semibold text-foreground">Materi &amp; Sumber Belajar</h2>
                        <p class="mt-2 text-sm text-muted-foreground">Akses materi pendukung bootcamp kamu.</p>
                        <a href="{{ $resourcesUrl }}"
                           class="mt-4 inline-flex items-center rounded-lg border border-border px-4 py-2 text-sm font-medium text-foreground hover:border-primary hover:text-primary transition">
                            Buka Halaman Materi
                        </a>
                    </div>
                @endif
            </div>

            <div class="space-y-6">
                <div class="rounded-xl border border-border bg-card shadow-sm">
                    <div class="border-b border-border px-6 py-4">
                        <h2 class="text-lg font-semibold text-foreground">Status Pembayaran</h2>
                    </div>
                    <div class="space-y-4 p-6 text-sm text-muted-foreground">
                        @if($latestOrder)
                            <div>
                                <p class="text-foreground font-semibold">Invoice</p>
                                <p>{{ $latestOrder->invoice_no }}</p>
                            </div>
                            <div>
                                <p class="text-foreground font-semibold">Jumlah</p>
                                <p>Rp {{ number_format($latestOrder->total, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-foreground font-semibold">Status Pembayaran</p>
                                <p>{{ $paymentMeta['label'] }}</p>
                            </div>
                            @php
                                $expiredAt = $latestOrder && $latestOrder->expired_at
                                    ? \Carbon\Carbon::parse($latestOrder->expired_at)
                                    : null;
                            @endphp
                            @if($latestOrder->status === 'pending' && $expiredAt)
                                <div>
                                    <p class="text-foreground font-semibold">Batas Pembayaran</p>
                                    <p>{{ $expiredAt->format('d M Y H:i') }}</p>
                                </div>
                            @endif
                            @if($latestPayment)
                                <div>
                                    <p class="text-foreground font-semibold">Metode Pembayaran Terakhir</p>
                                    <p class="capitalize">{{ $latestPayment->method ?? '-' }}</p>
                                    @php
                                        $paidAt = $latestPayment && $latestPayment->paid_at
                                            ? \Carbon\Carbon::parse($latestPayment->paid_at)
                                            : null;
                                    @endphp
                                    @if($paidAt)
                                        <p>Dibayar pada {{ $paidAt->format('d M Y H:i') }}</p>
                                    @endif
                                </div>
                            @endif
                        @else
                            <p class="text-sm text-muted-foreground">Belum ada informasi pembayaran untuk enrollment ini.</p>
                        @endif
                    </div>
                </div>

                <div class="rounded-xl border border-border bg-card shadow-sm p-6 text-sm text-muted-foreground">
                    <h2 class="text-lg font-semibold text-foreground">Butuh Bantuan?</h2>
                    <p class="mt-2">Hubungi tim admin kami melalui email <a href="mailto:support@bootcamp.com" class="text-primary hover:underline">support@bootcamp.com</a> atau WhatsApp resmi.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

