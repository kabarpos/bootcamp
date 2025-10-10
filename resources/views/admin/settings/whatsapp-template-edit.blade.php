@extends('layouts.admin')

@section('title', 'Edit WhatsApp Template')

@section('content')
<div class="px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Template WhatsApp</h1>
            <p class="text-gray-600">Sesuaikan pesan untuk template <strong>{{ $template->name }}</strong>.</p>
        </div>
        <a href="{{ route('admin.settings.whatsapp.edit') }}" class="text-sm text-gray-600 hover:text-gray-800">&larr; Kembali</a>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Informasi Template</h2>
            <p class="mt-1 text-sm text-gray-500">Gunakan placeholder: {{ implode(', ', $template->requiredPlaceholders()) ?: '-' }}</p>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.settings.whatsapp.templates.update', $template) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Template</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $template->name) }}"
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Isi Pesan</label>
                    <textarea name="content" id="content" rows="8"
                              class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" required>{{ old('content', $template->content) }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-2">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $template->is_active) ? 'checked' : '' }}
                           class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                    <label for="is_active" class="text-sm text-gray-700">Aktifkan template ini</label>
                </div>

                <div class="flex items-center justify-end gap-3">
                    <a href="{{ route('admin.settings.whatsapp.edit') }}" class="text-sm text-gray-600 hover:text-gray-800">Batal</a>
                    <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
