<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-foreground leading-tight">
                Selamat Datang, {{ Auth::user()->name }}!
            </h2>
            <div class="text-sm text-muted-foreground">
                {{ now()->format('l, d F Y') }}
            </div>
        </div>
    </x-slot>

    @php
        $stats = $stats ?? ['enrollments' => 0, 'certificates' => 0, 'total_spent' => 0];
        $purchases = collect($purchases ?? []);
        $recentEnrollments = $recentEnrollments ?? collect();
        $upcomingEvents = $upcomingEvents ?? collect();
        $blogPosts = $blogPosts ?? collect();
    @endphp

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Stats --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 overflow-hidden shadow-lg rounded-xl">
                    <div class="p-6 text-white">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-blue-100">Bootcamp Terdaftar</div>
                                <div class="text-2xl font-bold">{{ $stats['enrollments'] }}</div>
                                <p class="text-xs text-blue-100/80">Total program yang kamu ikuti</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-green-500 to-green-600 overflow-hidden shadow-lg rounded-xl">
                    <div class="p-6 text-white">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-green-100">Sertifikat Diperoleh</div>
                                <div class="text-2xl font-bold">{{ $stats['certificates'] }}</div>
                                <p class="text-xs text-green-100/80">Sertifikat yang sudah terbit</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-purple-500 to-purple-600 overflow-hidden shadow-lg rounded-xl">
                    <div class="p-6 text-white">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-purple-100">Total Pembelian</div>
                                <div class="text-2xl font-bold">Rp {{ number_format($stats['total_spent'], 0, ',', '.') }}</div>
                                <p class="text-xs text-purple-100/80">Akumulasi transaksi kamu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bootcamp Saya --}}
            <div class="bg-card overflow-hidden shadow-lg rounded-xl border border-border">
                <div class="px-6 py-4 border-b border-border flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-foreground">Bootcamp Saya</h3>
                    <span class="text-sm text-muted-foreground">{{ $stats['enrollments'] }} total program</span>
                </div>
                <div class="p-6">
                    @if($purchases->isEmpty())
                        <div class="rounded-xl border border-dashed border-border bg-card/40 p-8 text-center">
                            <h3 class="text-lg font-semibold text-foreground">Belum ada bootcamp yang kamu ikuti</h3>
                            <p class="mt-2 text-sm text-muted-foreground">Mulai perjalanan belajar kamu dengan mendaftar bootcamp pilihan.</p>
                            <a href="{{ route('public.bootcamps') }}"
                               class="mt-5 inline-flex items-center rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-primary-foreground hover:bg-primary/90 transition">
                                Cari Bootcamp
                            </a>
                        </div>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($purchases as $purchase)
                                <div class="rounded-lg border border-border bg-background p-4 shadow-sm transition hover:shadow-md">
                                    <a href="{{ $purchase['detail_url'] }}" class="block">
                                        <div class="flex flex-wrap items-center gap-3">
                                            <h4 class="text-sm font-semibold text-foreground">{{ $purchase['bootcamp_title'] }}</h4>
                                            @if($purchase['bootcamp_mode'])
                                                <span class="inline-flex items-center rounded-full bg-primary/10 px-2.5 py-1 text-[11px] font-medium text-primary">
                                                    {{ ucfirst($purchase['bootcamp_mode']) }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="mt-2 flex flex-wrap items-center gap-3 text-xs text-muted-foreground">
                                            @if($purchase['bootcamp_level'])
                                                <span class="inline-flex items-center gap-1">
                                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                                                    </svg>
                                                    Level {{ ucfirst($purchase['bootcamp_level']) }}
                                                </span>
                                            @endif
                                            @if($purchase['batch_code'])
                                                <span class="inline-flex items-center gap-1">
                                                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.5l4 4m-6 1.5l4-4m-5.25 1.75l-6.5 6.5a12.083 12.083 0 00-2.72 4.27L3 21l2.98-.53a12.083 12.083 0 004.27-2.72l6.5-6.5" />
                                                    </svg>
                                                    Batch {{ $purchase['batch_code'] }}
                                                </span>
                                            @endif
                                        </div>
                                        @if($purchase['date_range'] || $purchase['time_range'])
                                            <div class="mt-3 flex flex-wrap gap-3 text-xs text-muted-foreground">
                                                @if($purchase['date_range'])
                                                    <span class="inline-flex items-center gap-1">
                                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10m-12 8h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                        </svg>
                                                        {{ $purchase['date_range'] }}
                                                    </span>
                                                @endif
                                                @if($purchase['time_range'])
                                                    <span class="inline-flex items-center gap-1">
                                                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        {{ $purchase['time_range'] }}
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
                                        <div class="mt-4 flex flex-wrap items-center justify-between gap-2">
                                            <div class="flex flex-wrap gap-2">
                                                <span class="inline-flex items-center rounded-full px-2.5 py-1 text-[11px] font-semibold {{ $purchase['enrollment_status']['badge'] }}">
                                                    {{ $purchase['enrollment_status']['label'] }}
                                                </span>
                                                <span class="inline-flex items-center rounded-full px-2.5 py-1 text-[11px] font-semibold {{ $purchase['payment_status']['badge'] }}">
                                                    {{ $purchase['payment_status']['label'] }}
                                                </span>
                                            </div>
                                            @if($purchase['order_total'])
                                                <span class="text-sm font-semibold text-foreground">Rp {{ number_format($purchase['order_total'], 0, ',', '.') }}</span>
                                            @endif
                                        </div>
                                    </a>
                                    <div class="mt-3 flex flex-wrap items-center justify-between gap-2">
                                        @if($purchase['invoice_no'])
                                            <span class="text-xs text-muted-foreground">Invoice: {{ $purchase['invoice_no'] }}</span>
                                        @endif
                                        @if($purchase['checkout_url'])
                                            <a href="{{ $purchase['checkout_url'] }}" class="inline-flex items-center rounded-lg bg-primary px-3 py-2 text-xs font-semibold text-primary-foreground hover:bg-primary/90 transition">
                                                Selesaikan Pembayaran
                                            </a>
                                        @endif
                                    </div>
                                    @if($purchase['payment_status']['value'] === 'pending' && $purchase['expired_at'])
                                        <p class="mt-1 text-xs text-orange-600">Bayar sebelum {{ $purchase['expired_at'] }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- Upcoming Events & Resources --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="bg-card border border-border rounded-xl shadow-sm">
                    <div class="px-6 py-4 border-b border-border flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-foreground">Upcoming Events</h3>
                        <span class="text-xs uppercase tracking-wide text-muted-foreground">Stay in the loop</span>
                    </div>
                    <div class="p-6 space-y-4">
                        @foreach($upcomingEvents as $event)
                            <div class="flex items-start gap-3">
                                <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center text-sm font-semibold text-primary">
                                    {{ \Illuminate\Support\Carbon::parse($event['date'])->format('d M') }}
                                </div>
                                <div>
                                    <h4 class="font-semibold text-foreground">{{ $event['title'] }}</h4>
                                    <p class="text-sm text-muted-foreground">{{ $event['description'] }}</p>
                                    <span class="text-xs text-muted-foreground">{{ \Illuminate\Support\Carbon::parse($event['date'])->format('l, d F Y') }} · {{ $event['time'] }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-card border border-border rounded-xl shadow-sm">
                    <div class="px-6 py-4 border-b border-border flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-foreground">Resources for You</h3>
                        <span class="text-xs uppercase tracking-wide text-muted-foreground">Belajar terus berkembang</span>
                    </div>
                    <div class="p-6 space-y-4">
                        @foreach($blogPosts as $post)
                            <a href="#" class="block p-4 border border-border rounded-lg hover:border-primary transition-colors">
                                <h4 class="font-semibold text-foreground">{{ $post->title }}</h4>
                                <p class="mt-1 text-sm text-muted-foreground">{{ $post->excerpt }}</p>
                                <div class="mt-3 text-xs text-muted-foreground flex items-center gap-2">
                                    <span>{{ optional($post->author)->name ?? 'Tim Bootcamp' }}</span>
                                    <span>•</span>
                                    <span>{{ optional($post->published_at)->format('d M Y') ?? $post->created_at->format('d M Y') }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
