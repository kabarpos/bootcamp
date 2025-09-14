@extends('layouts.admin')

@section('content')
<div class="px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Enrollment</h1>
        <div class="flex space-x-2">
            <a href="{{ route('admin.enrollments.edit', $enrollment) }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200">
                Edit Enrollment
            </a>
            <a href="{{ route('admin.enrollments.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
                Kembali
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Informasi Enrollment</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">ID Enrollment</label>
                    <p class="text-gray-900 font-medium">{{ $enrollment->id }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                    <span class="px-2 py-1 rounded text-xs font-medium 
                        @if($enrollment->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($enrollment->status === 'confirmed') bg-blue-100 text-blue-800
                        @elseif($enrollment->status === 'completed') bg-green-100 text-green-800
                        @elseif($enrollment->status === 'cancelled') bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($enrollment->status) }}
                    </span>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Enrollment</label>
                    <p class="text-gray-900">{{ $enrollment->created_at->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Terakhir Diperbarui</label>
                    <p class="text-gray-900">{{ $enrollment->updated_at->format('d M Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Informasi Peserta</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Nama Peserta</label>
                    <p class="text-gray-900">{{ $enrollment->user->name ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Email Peserta</label>
                    <p class="text-gray-900">{{ $enrollment->user->email ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">ID User</label>
                    <p class="text-gray-900">{{ $enrollment->user->id ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Informasi Bootcamp & Batch</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Bootcamp</label>
                    <p class="text-gray-900">{{ $enrollment->batch->bootcamp->title ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Kode Batch</label>
                    <p class="text-gray-900">{{ $enrollment->batch->code ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Mulai</label>
                    <p class="text-gray-900">{{ $enrollment->batch->start_date ? $enrollment->batch->start_date->format('d M Y') : '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Selesai</label>
                    <p class="text-gray-900">{{ $enrollment->batch->end_date ? $enrollment->batch->end_date->format('d M Y') : '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Status Batch</label>
                    <span class="px-2 py-1 rounded text-xs font-medium 
                        @if($enrollment->batch->status === 'upcoming') bg-blue-100 text-blue-800
                        @elseif($enrollment->batch->status === 'ongoing') bg-yellow-100 text-yellow-800
                        @elseif($enrollment->batch->status === 'completed') bg-green-100 text-green-800
                        @elseif($enrollment->batch->status === 'cancelled') bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($enrollment->batch->status) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Informasi Order</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Invoice</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Discount</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($enrollment->orders as $order)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:underline">
                                {{ $order->invoice_no }}
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            Rp {{ number_format($order->amount, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            Rp {{ number_format($order->discount_amount, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 rounded text-xs font-medium 
                                @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($order->status === 'paid') bg-green-100 text-green-800
                                @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                @elseif($order->status === 'expired') bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                            Tidak ada order
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Informasi Sertifikat</h2>
        </div>
        <div class="p-6">
            @if($enrollment->certificate)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Nomor Sertifikat</label>
                    <p class="text-gray-900">{{ $enrollment->certificate->certificate_no }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                    @if($enrollment->certificate->isIssued())
                        <span class="px-2 py-1 rounded text-xs font-medium bg-green-100 text-green-800">
                            Sudah Diterbitkan
                        </span>
                    @else
                        <span class="px-2 py-1 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                            Belum Diterbitkan
                        </span>
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Diterbitkan</label>
                    <p class="text-gray-900">
                        {{ $enrollment->certificate->issued_at ? $enrollment->certificate->issued_at->format('d M Y H:i') : '-' }}
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Dibuat</label>
                    <p class="text-gray-900">{{ $enrollment->certificate->created_at->format('d M Y H:i') }}</p>
                </div>
                <div class="md:col-span-2">
                    <a href="{{ route('admin.certificates.show', $enrollment->certificate) }}" 
                       class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200">
                        Lihat Detail Sertifikat
                    </a>
                </div>
            </div>
            @else
            <p class="text-gray-500">Peserta ini belum memiliki sertifikat.</p>
            @endif
        </div>
    </div>
</div>
@endsection