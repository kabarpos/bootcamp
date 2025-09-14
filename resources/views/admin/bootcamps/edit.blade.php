@extends('layouts.admin')

@section('title', 'Edit Bootcamp')

@section('content')
<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Edit Bootcamp</h1>
            <p class="mt-2 text-sm text-gray-700">Edit informasi bootcamp "{{ $bootcamp->title }}".</p>
        </div>
    </div>

    <div class="mt-8 bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('admin.bootcamps.update', $bootcamp) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul Bootcamp</label>
                        <input type="text" name="title" id="title" 
                               value="{{ old('title', $bootcamp->title) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="mode" class="block text-sm font-medium text-gray-700">Mode</label>
                        <select name="mode" id="mode" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="online" {{ old('mode', $bootcamp->mode) == 'online' ? 'selected' : '' }}>Online</option>
                            <option value="offline" {{ old('mode', $bootcamp->mode) == 'offline' ? 'selected' : '' }}>Offline</option>
                            <option value="hybrid" {{ old('mode', $bootcamp->mode) == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                        </select>
                        @error('mode')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="level" class="block text-sm font-medium text-gray-700">Level</label>
                        <select name="level" id="level" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="beginner" {{ old('level', $bootcamp->level) == 'beginner' ? 'selected' : '' }}>Beginner</option>
                            <option value="intermediate" {{ old('level', $bootcamp->level) == 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                            <option value="advanced" {{ old('level', $bootcamp->level) == 'advanced' ? 'selected' : '' }}>Advanced</option>
                        </select>
                        @error('level')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="base_price" class="block text-sm font-medium text-gray-700">Harga Dasar (Rp)</label>
                        <input type="number" name="base_price" id="base_price" 
                               value="{{ old('base_price', $bootcamp->base_price) }}"
                               step="0.01"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('base_price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="duration_hours" class="block text-sm font-medium text-gray-700">Durasi (Jam)</label>
                        <input type="number" name="duration_hours" id="duration_hours" 
                               value="{{ old('duration_hours', $bootcamp->duration_hours) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('duration_hours')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="short_desc" class="block text-sm font-medium text-gray-700">Deskripsi Singkat</label>
                        <textarea name="short_desc" id="short_desc" rows="3"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('short_desc', $bootcamp->short_desc) }}</textarea>
                        @error('short_desc')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="syllabus_summary" class="block text-sm font-medium text-gray-700">Ringkasan Silabus</label>
                        <textarea name="syllabus_summary" id="syllabus_summary" rows="5"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('syllabus_summary', $bootcamp->syllabus_summary) }}</textarea>
                        @error('syllabus_summary')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kategori</label>
                        <div class="mt-1 grid grid-cols-1 gap-4 sm:grid-cols-2">
                            @foreach($categories as $category)
                                <div class="flex items-center">
                                    <input id="category-{{ $category->id }}" name="categories[]" type="checkbox" 
                                           value="{{ $category->id }}"
                                           {{ in_array($category->id, old('categories', $bootcamp->categories->pluck('id')->toArray())) ? 'checked' : '' }}
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

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Mentor</label>
                        <div class="mt-1 grid grid-cols-1 gap-4 sm:grid-cols-2">
                            @foreach($mentors as $mentor)
                                <div class="flex items-center">
                                    <input id="mentor-{{ $mentor->id }}" name="mentors[]" type="checkbox" 
                                           value="{{ $mentor->id }}"
                                           {{ in_array($mentor->id, old('mentors', $bootcamp->mentors->pluck('id')->toArray())) ? 'checked' : '' }}
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
                                   value="1" {{ old('is_active', $bootcamp->is_active) ? 'checked' : '' }}
                                   class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                Aktif
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <a href="{{ route('admin.bootcamps.index') }}" class="text-sm font-semibold leading-6 text-gray-900">
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