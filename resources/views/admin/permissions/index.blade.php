@extends('layouts.admin')

@section('title', 'Permissions')

@section('content')
<div class="px-6 py-8">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Permissions</h1>
            <p class="text-gray-600">Kelola daftar permission yang dapat digunakan oleh setiap role.</p>
        </div>
        <form method="GET" class="flex items-center gap-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari permission..."
                   class="rounded-lg border border-border bg-white px-3 py-2 text-sm focus:border-primary focus:ring focus:ring-primary/30">
            <button type="submit" class="rounded-lg bg-primary px-3 py-2 text-sm font-semibold text-white hover:bg-primary/90 transition">
                Cari
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-1">
            <div class="rounded-xl border border-border bg-white shadow-sm">
                <div class="border-b border-border px-6 py-4">
                    <h2 class="text-lg font-semibold text-foreground">Tambah Permission</h2>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.permissions.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Permission</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                   class="mt-1 block w-full rounded-lg border border-border px-3 py-2 text-sm focus:border-primary focus:ring focus:ring-primary/30">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="guard_name" class="block text-sm font-medium text-gray-700">Guard Name</label>
                            <input type="text" id="guard_name" name="guard_name" value="{{ old('guard_name', 'web') }}"
                                   class="mt-1 block w-full rounded-lg border border-border px-3 py-2 text-sm focus:border-primary focus:ring focus:ring-primary/30">
                            @error('guard_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit" class="w-full rounded-lg bg-primary px-4 py-2 text-sm font-semibold text-white hover:bg-primary/90 transition">
                            Simpan Permission
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="overflow-hidden rounded-xl border border-border bg-white shadow-sm">
                <table class="min-w-full divide-y divide-border">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-muted-foreground">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-muted-foreground">Guard</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wide text-muted-foreground">Digunakan Role</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wide text-muted-foreground">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border bg-white">
                        @forelse($permissions as $permission)
                            <tr>
                                <td class="px-6 py-4 text-sm text-foreground">{{ $permission->name }}</td>
                                <td class="px-6 py-4 text-sm text-muted-foreground">{{ $permission->guard_name }}</td>
                                <td class="px-6 py-4 text-sm text-muted-foreground">{{ $permission->roles()->count() }}</td>
                                <td class="px-6 py-4 text-right text-sm">
                                    <a href="{{ route('admin.permissions.edit', $permission) }}" class="text-primary hover:text-primary/80 mr-3">Edit</a>
                                    <form action="{{ route('admin.permissions.destroy', $permission) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Hapus permission ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-6 text-center text-sm text-muted-foreground">Belum ada permission.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-6 py-4 border-t border-border">
                    {{ $permissions->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

