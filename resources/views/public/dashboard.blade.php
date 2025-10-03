@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-background py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-foreground">Halo, {{ Auth::user()->name }}!</h1>
                <p class="mt-2 text-muted-foreground">Kelola dan ikuti perkembangan bootcamp yang sudah kamu daftarkan.</p>
            </div>
            <a href="{{ route('public.bootcamps') }}"
               class="inline-flex items-center justify-center rounded-lg border border-border px-4 py-2 text-sm font-medium text-foreground hover:border-primary hover:text-primary transition">
                Jelajahi Bootcamp Lainnya
            </a>
        </div>

        @php
            $stats = $stats ?? ['enrollments' => 0, 'certificates' => 0, 'total_spent' => 0];
            $purchases = collect($purchases ?? []);
            $upcomingEvents = collect($upcomingEvents ?? []);
            $blogPosts = collect($blogPosts ?? []);
        @endphp

        <div class="mt-10 grid grid-cols-1 gap-4 md:grid-cols-3">
            <div class="rounded-xl border border-border bg-card p-5 shadow-sm">
                <p class="text-sm text-muted-foreground">Bootcamp Terdaftar</p>
                <p class="mt-2 text-2xl font-bold text-foreground">{{ $stats['enrollments'] }}</p>
                <p class="mt-1 text-xs text-muted-foreground">Total program yang sedang kamu ikuti</p>
            </div>
            <div class="rounded-xl border border-border bg-card p-5 shadow-sm">
                <p class="text-sm text-muted-foreground">Sertifikat Diterima</p>
                <p class="mt-2 text-2xl font-bold text-foreground">{{ $stats['certificates'] }}</p>
                <p class="mt-1 text-xs text-muted-foreground">Sertifikat yang sudah terbit</p>
            </div>
            <div class="rounded-xl border border-border bg-card p-5 shadow-sm">
                <p class="text-sm text-muted-foreground">Total Pembelian</p>
                <p class="mt-2 text-2xl font-bold text-foreground">Rp {{ number_format($stats['total_spent'], 0, ',', '.') }}</p>
                <p class="mt-1 text-xs text-muted-foreground">Akumulasi transaksi yang berhasil</p>
            </div>
        </div>

        <div class="mt-12">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <h2 class="text-xl font-semibold text-foreground">Bootcamp Saya</h2>
                    <p class="mt-1 text-sm text-muted-foreground">Lihat status pembayaran dan detail batch yang kamu ikuti.</p>
                </div>
            </div>

            @if($purchases->isEmpty())
                <div class="mt-6 rounded-xl border border-dashed border-border bg-card/40 p-10 text-center">
                    <h3 class="text-lg font-semibold text-foreground">Belum ada bootcamp yang kamu ikuti</h3>
                    <p class="mt-2 text-sm text-muted-foreground">Mulai perjalanan belajar kamu dengan mendaftar bootcamp pilihan.</p>
                    <a href="{{ route('public.bootcamps') }}"
                       class="mt-5 inline-flex items-center rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-primary-foreground hover:bg-primary/90 transition">
                        Cari Bootcamp
                    </a>
                </div>
            @else
                <div class="mt-6 space-y-6">
                    @foreach($purchases as $purchase)
                        <div class="rounded-xl border border-border bg-card shadow-sm transition hover:shadow-md">
                            <div class="flex flex-col gap-6 p-6 md:flex-row md:items-start md:justify-between">
                                <div>
                                    <div class="flex flex-wrap items-center gap-3">
                                        <h3 class="text-lg font-semibold text-foreground">{{ $purchase['bootcamp_title'] }}</h3>
                                        @if($purchase['bootcamp_mode'])
                                            <span class="inline-flex items-center rounded-full bg-primary/10 px-3 py-1 text-xs font-medium text-primary">
                                                {{ ucfirst($purchase['bootcamp_mode']) }}
                                            </span>
                                        @endif
                                    </div>

                                    <div class="mt-2 flex flex-wrap items-center gap-3 text-sm text-muted-foreground">
                                        @if($purchase['bootcamp_level'])
                                            <span class="inline-flex items-center gap-1">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                                                </svg>
                                                Level {{ ucfirst($purchase['bootcamp_level']) }}
                                            </span>
                                        @endif
                                        @if($purchase['batch_code'])
                                            <span class="inline-flex items-center gap-1">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.5l4 4m-6 1.5l4-4m-5.25 1.75l-6.5 6.5a12.083 12.083 0 00-2.72 4.27L3 21l2.98-.53a12.083 12.083 0 004.27-2.72l6.5-6.5" />
                                                </svg>
                                                Batch {{ $purchase['batch_code'] }}
                                            </span>
                                        @endif
                                    </div>

                                    @if($purchase['date_range'] || $purchase['time_range'])
                                        <div class="mt-4 flex flex-wrap gap-4 text-sm text-muted-foreground">
                                            @if($purchase['date_range'])
                                                <span class="inline-flex items-center gap-2">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10m-12 8h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                    {{ $purchase['date_range'] }}
                                                </span>
                                            @endif
                                            @if($purchase['time_range'])
                                                <span class="inline-flex items-center gap-2">
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                    </svg>
                                                    {{ $purchase['time_range'] }}
                                                </span>
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                <div class="flex flex-col items-end gap-3">
                                    <div class="flex flex-wrap justify-end gap-2">
                                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $purchase['enrollment_status']['badge'] }}">
                                            {{ $purchase['enrollment_status']['label'] }}
                                        </span>
                                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $purchase['payment_status']['badge'] }}">
                                            {{ $purchase['payment_status']['label'] }}
                                        </span>
                                    </div>
                                    @if($purchase['invoice_no'])
                                        <p class="text-xs text-muted-foreground">Invoice: {{ $purchase['invoice_no'] }}</p>
                                    @endif
                                    @if($purchase['order_total'])
                                        <p class="text-sm font-semibold text-foreground">Rp {{ number_format($purchase['order_total'], 0, ',', '.') }}</p>
                                    @endif
                                    <div class="flex flex-wrap justify-end gap-2">
                                        <a href="{{ $purchase['detail_url'] }}"
                                           class="inline-flex items-center rounded-lg border border-border px-3 py-2 text-xs font-medium text-foreground hover:border-primary hover:text-primary transition">
                                            Lihat Detail
                                        </a>
                                        @if($purchase['checkout_url'])
                                            <a href="{{ $purchase['checkout_url'] }}"
                                               class="inline-flex items-center rounded-lg bg-primary px-3 py-2 text-xs font-semibold text-primary-foreground hover:bg-primary/90 transition">
                                                Selesaikan Pembayaran
                                            </a>
                                        @endif
                                    </div>
                                    @if($purchase['payment_status']['value'] === 'pending' && $purchase['expired_at'])
                                        <p class="text-xs text-orange-600">Bayar sebelum {{ $purchase['expired_at'] }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="mt-12 grid grid-cols-1 gap-6 lg:grid-cols-2">
            <div class="rounded-xl border border-border bg-card shadow-sm">
                <div class="flex items-center justify-between border-b border-border px-6 py-4">
                    <div>
                        <h3 class="text-lg font-semibold text-foreground">Agenda Terdekat</h3>
                        <p class="text-xs text-muted-foreground">Catat jadwal penting agar tidak terlewat.</p>
                    </div>
                </div>
                <div class="space-y-4 p-6">
                    @forelse($upcomingEvents as $event)
                        <div class="flex items-start gap-3">
                            <div class="flex h-12 w-12 flex-col items-center justify-center rounded-lg bg-primary/10 text-xs font-semibold text-primary">
                                {{ \Carbon\Carbon::parse($event['date'])->format('d') }}
                                <span class="text-[10px] uppercase">{{ \Carbon\Carbon::parse($event['date'])->format('M') }}</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-foreground">{{ $event['title'] }}</h4>
                                <p class="text-sm text-muted-foreground">{{ $event['description'] }}</p>
                                <p class="mt-1 text-xs text-muted-foreground">{{ \Carbon\Carbon::parse($event['date'])->translatedFormat('l, d F Y') }} â€¢ {{ $event['time'] }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-muted-foreground">Tidak ada agenda terbaru saat ini.</p>
                    @endforelse
                </div>
            </div>

            <div class="rounded-xl border border-border bg-card shadow-sm">
                <div class="flex items-center justify-between border-b border-border px-6 py-4">
                    <div>
                        <h3 class="text-lg font-semibold text-foreground">Insight Terbaru</h3>
                        <p class="text-xs text-muted-foreground">Artikel dan pembelajaran untuk mendukung progres kamu.</p>
                    </div>
                </div>
                <div class="space-y-4 p-6">
                    @forelse($blogPosts as $post)
                        <a href="#" class="block rounded-lg border border-border p-4 transition hover:border-primary">
                            <h4 class="font-semibold text-foreground">{{ $post->title }}</h4>
                            <p class="mt-1 text-sm text-muted-foreground">{{ $post->excerpt }}</p>
                            <div class="mt-3 text-xs text-muted-foreground flex items-center gap-2">
                                <span>{{ optional($post->author)->name ?? 'Tim Bootcamp' }}</span>
                                <span>&bull;</span>
                                <span>{{ optional($post->published_at ?? $post->created_at)->format('d M Y') }}</span>
                            </div>
                        </a>
                    @empty
                        <p class="text-sm text-muted-foreground">Konten terbaru akan segera hadir.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection











