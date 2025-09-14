@extends('layouts.admin')

@section('title', 'Edit Sertifikat')

@section('content')
<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Edit Sertifikat</h1>
            <p class="mt-2 text-sm text-gray-700">Edit informasi sertifikat "{{ $certificate->certificate_no }}".</p>
        </div>
    </div>

    <div class="mt-8 bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('admin.certificates.update', $certificate) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="enrollment_id" class="block text-sm font-medium text-gray-700">Enrollment</label>
                        <select name="enrollment_id" id="enrollment_id" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @foreach($enrollments as $enrollment)
                                <option value="{{ $enrollment->id }}" {{ old('enrollment_id', $certificate->enrollment_id) == $enrollment->id ? 'selected' : '' }}>
                                    {{ $enrollment->user->name }} - {{ $enrollment->batch->code }} ({{ $enrollment->batch->bootcamp->title }})
                                </option>
                            @endforeach
                        </select>
                        @error('enrollment_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="certificate_no" class="block text-sm font-medium text-gray-700">Nomor Sertifikat</label>
                        <input type="text" name="certificate_no" id="certificate_no" 
                               value="{{ old('certificate_no', $certificate->certificate_no) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" readonly>
                        @error('certificate_no')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="issued_at" class="block text-sm font-medium text-gray-700">Tanggal Terbit</label>
                        <input type="datetime-local" name="issued_at" id="issued_at" 
                               value="{{ old('issued_at', $certificate->issued_at ? $certificate->issued_at->format('Y-m-d\TH:i') : '') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('issued_at')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="file_url" class="block text-sm font-medium text-gray-700">URL File</label>
                        <input type="text" name="file_url" id="file_url" 
                               value="{{ old('file_url', $certificate->file_url) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" readonly>
                        @error('file_url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <a href="{{ route('admin.certificates.index') }}" class="text-sm font-semibold leading-6 text-gray-900">
                        Batal
                    </a>
                    <button type="submit" 
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection