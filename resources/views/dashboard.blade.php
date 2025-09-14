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

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Bootcamp Terdaftar -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 overflow-hidden shadow-lg rounded-xl">
                    <div class="p-6 text-white">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-blue-100">
                                    Bootcamp Terdaftar
                                </div>
                                <div class="text-2xl font-bold">
                                    {{ Auth::user()->enrollments()->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sertifikat Diperoleh -->
                <div class="bg-gradient-to-r from-green-500 to-green-600 overflow-hidden shadow-lg rounded-xl">
                    <div class="p-6 text-white">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-green-100">
                                    Sertifikat Diperoleh
                                </div>
                                <div class="text-2xl font-bold">
                                    {{ Auth::user()->certificates()->whereNotNull('issued_at')->count() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Pembelian -->
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 overflow-hidden shadow-lg rounded-xl">
                    <div class="p-6 text-white">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-purple-100">
                                    Total Pembelian
                                </div>
                                <div class="text-2xl font-bold">
                                    Rp {{ number_format(Auth::user()->orders()->where('orders.status', 'paid')->sum('total'), 0, ',', '.') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootcamp Saya -->
            <div class="bg-card overflow-hidden shadow-lg rounded-xl border border-border">
                <div class="px-6 py-4 border-b border-border">
                    <h3 class="text-lg font-semibold text-foreground">Bootcamp Saya</h3>
                </div>
                <div class="p-6">
                    @if(Auth::user()->enrollments()->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach(Auth::user()->enrollments()->with(['batch.bootcamp'])->latest()->take(6)->get() as $enrollment)
                                <div class="bg-background border border-border rounded-lg p-4 hover:shadow-md transition-shadow">
                                    <div class="flex items-start justify-between mb-3">
                                        <h4 class="font-semibold text-foreground text-sm">{{ $enrollment->batch->bootcamp->title }}</h4>
                                        <span class="px-2 py-1 text-xs rounded-full 
                                            @if($enrollment->status === 'active') bg-green-100 text-green-800
                                            @elseif($enrollment->status === 'completed') bg-blue-100 text-blue-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($enrollment->status) }}
                                        </span>
                                    </div>
                                    <p class="text-muted-foreground text-xs mb-2">Batch: {{ $enrollment->batch->code }}</p>
                                    <p class="text-muted-foreground text-xs">Mulai: {{ $enrollment->batch->start_date->format('d M Y') }}</p>
                                    @if($enrollment->certificate && $enrollment->certificate->issued_at)
                                        <div class="mt-3">
                                            <a href="#" class="inline-flex items-center text-xs text-blue-600 hover:text-blue-800">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                Download Sertifikat
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        @if(Auth::user()->enrollments()->count() > 6)
                            <div class="mt-4 text-center">
                                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Lihat Semua Bootcamp →</a>
                            </div>
                        @endif
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-muted-foreground" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-foreground">Belum ada bootcamp</h3>
                            <p class="mt-1 text-sm text-muted-foreground">Mulai perjalanan belajar Anda dengan mendaftar bootcamp pertama.</p>
                            <div class="mt-6">
                                <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Jelajahi Bootcamp
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Bootcamp Tersedia -->
            <div class="bg-card overflow-hidden shadow-lg rounded-xl border border-border">
                <div class="px-6 py-4 border-b border-border">
                    <h3 class="text-lg font-semibold text-foreground">Bootcamp Tersedia</h3>
                </div>
                <div class="p-6">
                    @php
                        $availableBootcamps = \App\Models\Bootcamp::with(['batches' => function($query) {
                            $query->where('start_date', '>', now());
                        }])->where('is_active', true)->take(3)->get();
                    @endphp
                    
                    @if($availableBootcamps->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($availableBootcamps as $bootcamp)
                                <div class="bg-background border border-border rounded-lg overflow-hidden hover:shadow-lg transition-shadow">
                                    <div class="p-6">
                                        <h4 class="font-semibold text-foreground mb-2">{{ $bootcamp->title }}</h4>
                                        <p class="text-muted-foreground text-sm mb-4 line-clamp-3">{{ Str::limit($bootcamp->description, 100) }}</p>
                                        <div class="flex items-center justify-between mb-4">
                                            <span class="text-lg font-bold text-blue-600">Rp {{ number_format($bootcamp->price, 0, ',', '.') }}</span>
                                            <span class="text-sm text-muted-foreground">{{ $bootcamp->duration }} hari</span>
                                        </div>
                                        @if($bootcamp->batches->count() > 0)
                                            <div class="mb-4">
                                                <p class="text-xs text-muted-foreground mb-1">Batch terdekat:</p>
                                                <p class="text-sm font-medium">{{ $bootcamp->batches->first()->start_date->format('d M Y') }}</p>
                                            </div>
                                        @endif
                                        <a href="#" class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            Daftar Sekarang
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <p class="text-muted-foreground">Tidak ada bootcamp yang tersedia saat ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>