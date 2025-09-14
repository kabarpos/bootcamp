@extends('layouts.admin')

@section('title', 'Tambah Certificate')

@section('content')
<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Tambah Certificate</h1>
            <p class="mt-2 text-sm text-gray-700">Buat sertifikat baru untuk enrollment yang telah selesai.</p>
        </div>
    </div>

    <div class="mt-8 bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('admin.certificates.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="enrollment_id" class="block text-sm font-medium text-gray-700">Enrollment</label>
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
                               class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indixdigo-500"
                               {{ old('issue_immediately') ? 'checked' : '' }}>
                        <label for="issue_immediately" class="ml-2 block text-sm text-gray-900">
                            Terbitkan segera
                        </label>
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