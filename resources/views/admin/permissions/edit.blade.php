@extends('layouts.admin')

@section('title', 'Edit Permission')

@section('content')
<div class="px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Permission</h1>
            <p class="text-gray-600">Perbarui informasi permission "{{ $permission->name }}".</p>
        </div>
        <a href="{{ route('admin.permissions.index') }}" class="rounded-lg bg-gray-500 px-4 py-2 text-sm font-medium text-white hover:bg-gray-600 transition">Kembali</a>
    </div>

    <div class="overflow-hidden rounded-xl border border-border bg-white shadow-sm">
        <div class="border-b border-border px-6 py-4">
            <h2 class="text-lg font-semibold text-foreground">Formulir Edit Permission</h2>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.permissions.update', $permission) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Permission</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $permission->name) }}" required
                           class="mt-1 block w-full rounded-lg border border-border px-3 py-2 text-sm focus:border-primary focus:ring focus:ring-primary/30">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="guard_name" class="block text-sm font-medium text-gray-700">Guard Name</label>
                    <input type="text" id="guard_name" name="guard_name" value="{{ old('guard_name', $permission->guard_name) }}"
                           class="mt-1 block w-full rounded-lg border border-border px-3 py-2 text-sm focus:border-primary focus:ring focus:ring-primary/30">
                    @error('guard_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end gap-3">
                    <button type="submit" class="rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-white hover:bg-primary/90 transition">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
