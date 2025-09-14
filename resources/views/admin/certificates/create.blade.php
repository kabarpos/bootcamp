@extends('layouts.admin')

@section('title', 'Tambah Certificate')

@section('content')
<div class="px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Tambah Certificate</h1>
            <p class="text-gray-600">Buat sertifikat baru untuk enrollment yang telah selesai.</p>
        </div>
        <a href="{{ route('admin.certificates.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Formulir Sertifikat Baru</h2>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.certificates.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="enrollment_id" class="block text-sm font-medium text-gray-700 mb-1">Enrollment</label>
                        <select name="enrollment_id" id="enrollment_id" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">Pilih Enrollment</option>
                            @foreach($enrollments as $enrollment)
                                <option value="{{ $enrollment->id }}" 
                                        {{ old('enrollment_id') == $enrollment->id ? 'selected' : '' }}>
                                    {{ $enrollment->user->name ?? 'N/A' }} - 
                                    {{ $enrollment->batch->bootcamp->title ?? 'N/A' }} - 
                                    {{ $enrollment->batch->code ?? 'N/A' }}
                                </option>
                            @endforeach
                        </select>
                        @error('enrollment_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input id="issue_immediately" name="issue_immediately" type="checkbox" 
                               class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                               {{ old('issue_immediately') ? 'checked' : '' }}>
                        <label for="issue_immediately" class="ml-2 block text-sm text-gray-900">
                            Terbitkan segera
                        </label>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-4">
                    <button type="submit" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition duration-200">
                        Simpan Sertifikat
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection