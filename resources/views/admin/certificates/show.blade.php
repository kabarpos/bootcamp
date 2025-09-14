@extends('layouts.admin')

@section('content')
<div class="px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Detail Sertifikat</h1>
        <div class="flex space-x-2">
            <a href="{{ route('admin.certificates.edit', $certificate) }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition duration-200">
                Edit Sertifikat
            </a>
            <a href="{{ route('admin.certificates.index') }}" 
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
                Kembali
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Informasi Sertifikat</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Nomor Sertifikat</label>
                    <p class="text-gray-900 font-medium">{{ $certificate->certificate_no }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Status</label>
                    @if($certificate->isIssued())
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
                        {{ $certificate->issued_at ? $certificate->issued_at->format('d M Y H:i') : '-' }}
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Dibuat</label>
                    <p class="text-gray-900">{{ $certificate->created_at->format('d M Y H:i') }}</p>
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
                    <p class="text-gray-900">{{ $certificate->enrollment->user->name ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Email Peserta</label>
                    <p class="text-gray-900">{{ $certificate->enrollment->user->email ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Bootcamp</label>
                    <p class="text-gray-900">{{ $certificate->enrollment->batch->bootcamp->title ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Batch</label>
                    <p class="text-gray-900">{{ $certificate->enrollment->batch->code ?? '-' }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Tanggal Enrollment</label>
                    <p class="text-gray-900">{{ $certificate->enrollment->created_at->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-1">Status Enrollment</label>
                    <span class="px-2 py-1 rounded text-xs font-medium 
                        @if($certificate->enrollment->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($certificate->enrollment->status === 'confirmed') bg-blue-100 text-blue-800
                        @elseif($certificate->enrollment->status === 'completed') bg-green-100 text-green-800
                        @elseif($certificate->enrollment->status === 'cancelled') bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($certificate->enrollment->status) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">Aksi</h2>
            <div class="flex space-x-2">
                @if($certificate->isIssued())
                    <form action="{{ route('admin.certificates.revoke', $certificate) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition duration-200"
                                onclick="return confirm('Apakah Anda yakin ingin mencabut sertifikat ini?')">
                            Cabut Sertifikat
                        </button>
                    </form>
                    <a href="{{ route('admin.certificates.download', $certificate) }}" 
                       class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition duration-200">
                        Download PDF
                    </a>
                @else
                    <form action="{{ route('admin.certificates.issue', $certificate) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" 
                                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition duration-200"
                                onclick="return confirm('Apakah Anda yakin ingin menerbitkan sertifikat ini?')">
                            Terbitkan Sertifikat
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection