@extends('layouts.admin')

@section('title', 'Tambah Bootcamp')

@section('content')
<div class="px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Tambah Bootcamp</h1>
            <p class="text-gray-600">Buat bootcamp baru dengan kategori dan mentor.</p>
        </div>
        <a href="{{ route('admin.bootcamps.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Formulir Bootcamp Baru</h2>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.bootcamps.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Bootcamp</label>
                        <input type="text" name="title" id="title" 
                               value="{{ old('title') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="mode" class="block text-sm font-medium text-gray-700 mb-1">Mode</label>
                        <select name="mode" id="mode" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="online" {{ old('mode') == 'online' ? 'selected' : '' }}>Online</option>
                            <option value="offline" {{ old('mode') == 'offline' ? 'selected' : '' }}>Offline</option>
                            <option value="hybrid" {{ old('mode') == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                        @error('mode')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="level" class="block text-sm font-medium text-gray-700 mb-1">Level</label>
                        <select name="level" id="level" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="beginner" {{ old('level') == 'beginner' ? 'selected' : '' }}>Beginner</option>
                            <option value="intermediate" {{ old('level') == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="advanced" {{ old('level') == 'advanced' ? 'selected' : '' }}>Advanced</option>
                        </select>
                        @error('level')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="base_price" class="block text-sm font-medium text-gray-700 mb-1">Harga Dasar (Rp)</label>
                        <input type="number" name="base_price" id="base_price" 
                               value="{{ old('base_price') }}"
                               step="0.01"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('base_price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="duration_hours" class="block text-sm font-medium text-gray-700 mb-1">Durasi (Jam)</label>
                        <input type="number" name="duration_hours" id="duration_hours" 
                               value="{{ old('duration_hours') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('duration_hours')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="short_desc" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Singkat</label>
                        <textarea name="short_desc" id="short_desc" rows="3"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('short_desc') }}</textarea>
                        @error('short_desc')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="syllabus_summary" class="block text-sm font-medium text-gray-700 mb-1">Ringkasan Silabus</label>
                        <textarea name="syllabus_summary" id="syllabus_summary" rows="5"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('syllabus_summary') }}</textarea>
                        @error('syllabus_summary')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                        <div class="mt-1 grid grid-cols-1 gap-4 sm:grid-cols-2">
                            @foreach($categories as $category)
                                <div class="flex items-center">
                                    <input id="category-{{ $category->id }}" name="categories[]" type="checkbox" 
                                           value="{{ $category->id }}"
                                           class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="category-{{ $category->id }}" class="ml-3 block text-sm text-gray-700">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('categories')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mentor</label>
                        <div class="mt-1 grid grid-cols-1 gap-4 sm:grid-cols-2">
                            @foreach($mentors as $mentor)
                                <div class="flex items-center">
                                    <input id="mentor-{{ $mentor->id }}" name="mentors[]" type="checkbox" 
                                           value="{{ $mentor->id }}"
                                           class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="mentor-{{ $mentor->id }}" class="ml-3 block text-sm text-gray-700">
                                        {{ $mentor->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('mentors')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <div class="flex items-center">
                            <input id="is_active" name="is_active" type="checkbox" 
                                   value="1" {{ old('is_active') ? 'checked' : '' }}
                                   class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                Aktif
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-4">
                    <button type="submit" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition duration-200">
                        Simpan Bootcamp
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection