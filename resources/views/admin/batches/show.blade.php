@extends('layouts.admin')

@section('content')
<div class="px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Batch</h1>
        <div class="flex space-x-2">
            <a href="{{ route('admin.batches.edit', $batch) }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200">
                Edit Batch
            </a>
            <a href="{{ route('admin.batches.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
                Kembali
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Informasi Batch</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Bootcamp</label>
                    <p class="text-gray-900">{{ $batch->bootcamp->title ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Kode Batch</label>
                    <p class="text-gray-900">{{ $batch->code }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Mulai</label>
                    <p class="text-gray-900">{{ $batch->start_date->format('d M Y') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Selesai</label>
                    <p class="text-gray-900">{{ $batch->end_date->format('d M Y') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Waktu</label>
                    <p class="text-gray-900">{{ $batch->start_time }} - {{ $batch->end_time }} WIB</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                    <span class="px-2 py-1 rounded text-xs font-medium 
                        @if($batch->status === 'upcoming') bg-blue-100 text-blue-800
                        @elseif($batch->status === 'ongoing') bg-yellow-100 text-yellow-800
                        @elseif($batch->status === 'completed') bg-green-100 text-green-800
                        @elseif($batch->status === 'cancelled') bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($batch->status) }}
                    </span>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Kapasitas</label>
                    <p class="text-gray-900">{{ $batch->capacity }} peserta</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Peserta Terdaftar</label>
                    <p class="text-gray-900">{{ $batch->enrolled_count }} peserta</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Lokasi & Platform</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Kota</label>
                    <p class="text-gray-900">{{ $batch->city->name ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Nama Venue</label>
                    <p class="text-gray-900">{{ $batch->venue_name ?? '-' }}</p>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-600 mb-1">Alamat Venue</label>
                    <p class="text-gray-900">{{ $batch->venue_address ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Platform Meeting</label>
                    <p class="text-gray-900">{{ $batch->meeting_platform ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Link Meeting</label>
                    <p class="text-gray-900">{{ $batch->meeting_link ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Peserta Terdaftar ({{ $batch->enrollments->count() }})</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($batch->enrollments as $enrollment)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $enrollment->user->name ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $enrollment->user->email ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 rounded text-xs font-medium 
                                @if($enrollment->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($enrollment->status === 'confirmed') bg-blue-100 text-blue-800
                                @elseif($enrollment->status === 'completed') bg-green-100 text-green-800
                                @elseif($enrollment->status === 'cancelled') bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($enrollment->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $enrollment->created_at->format('d M Y H:i') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                            Tidak ada peserta terdaftar
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection