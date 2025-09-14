@extends('layouts.admin')

@section('title', 'Edit Role')

@section('content')
<div class="px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Role</h1>
            <p class="text-gray-600">Edit informasi role "{{ $role->name }}".</p>
        </div>
        <a href="{{ route('admin.roles.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Formulir Edit Role</h2>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.roles.update', $role) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Role</label>
                        <input type="text" name="name" id="name" 
                               value="{{ old('name', $role->name) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="guard_name" class="block text-sm font-medium text-gray-700 mb-1">Guard Name</label>
                        <input type="text" name="guard_name" id="guard_name" 
                               value="{{ old('guard_name', $role->guard_name) }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('guard_name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Permissions</label>
                        <div class="mt-1 grid grid-cols-1 gap-4 sm:grid-cols-2">
                            @foreach($permissions as $permission)
                                <div class="flex items-center">
                                    <input id="permission-{{ $permission->id }}" name="permissions[]" type="checkbox" 
                                           value="{{ $permission->id }}"
                                           {{ in_array($permission->id, old('permissions', $role->permissions->pluck('id')->toArray())) ? 'checked' : '' }}
                                           class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="permission-{{ $permission->id }}" class="ml-3 block text-sm text-gray-700">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        @error('permissions')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-4">
                    <button type="submit" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition duration-200">
                        Update Role
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection