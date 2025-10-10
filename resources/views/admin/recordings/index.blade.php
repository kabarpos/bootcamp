@extends('layouts.admin')

@section('title', 'Rekaman Bootcamp')

@section('content')
<div class="px-6 py-8 space-y-6">
    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Rekaman Bootcamp</h1>
            <p class="text-sm text-gray-600">Kelola video rekaman sesi bootcamp untuk peserta batch terkait.</p>
        </div>
        <a href="{{ route('admin.recordings.create') }}"
           class="inline-flex items-center gap-2 rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
            Tambah Rekaman
        </a>
    </div>

    @if(session('success'))
        <div class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            {{ session('success') }}
        </div>
    @endif

    <form method="GET" class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm">
        <div class="grid gap-4 md:grid-cols-4">
            <div class="md:col-span-2">
                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Pencarian</label>
                <input id="search" type="text" name="search" value="{{ $filters['search'] ?? '' }}"
                       placeholder="Cari berdasarkan judul atau deskripsi"
                       class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="bootcamp_id" class="block text-sm font-medium text-gray-700 mb-1">Bootcamp</label>
                <select id="bootcamp_id" name="bootcamp_id"
                        class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Semua Bootcamp</option>
                    @foreach($bootcamps as $bootcamp)
                        <option value="{{ $bootcamp->id }}" @selected(($filters['bootcamp_id'] ?? '') == $bootcamp->id)>
                            {{ $bootcamp->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="batch_id" class="block text-sm font-medium text-gray-700 mb-1">Batch</label>
                <select id="batch_id" name="batch_id"
                        class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Semua Batch</option>
                    @foreach($batches as $batch)
                        <option value="{{ $batch->id }}" @selected(($filters['batch_id'] ?? '') == $batch->id)>
                            {{ optional($batch->bootcamp)->title }} — {{ $batch->code }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select id="status" name="status"
                        class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Semua Status</option>
                    <option value="1" @selected(($filters['status'] ?? '') === '1')>Published</option>
                    <option value="0" @selected(($filters['status'] ?? '') === '0')>Draft</option>
                </select>
            </div>
        </div>
        <div class="mt-4 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-end">
            <a href="{{ route('admin.recordings.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Reset</a>
            <button type="submit"
                    class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 transition">
                Terapkan
            </button>
        </div>
    </form>

    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Bootcamp</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Batch</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Rekaman</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white text-sm text-gray-700">
                    @forelse($recordings as $recording)
                        <tr>
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-900">{{ $recording->title }}</p>
                                @if($recording->description)
                                    <p class="mt-1 text-xs text-gray-500 line-clamp-2">{{ $recording->description }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                {{ optional(optional($recording->batch)->bootcamp)->title ?? '—' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ optional($recording->batch)->code ?? '—' }}
                            </td>
                            <td class="px-6 py-4">
                                @if($recording->recorded_at)
                                    <p class="text-xs text-gray-500">Direkam {{ $recording->recorded_at->format('d M Y H:i') }}</p>
                                @else
                                    <p class="text-xs text-gray-400">Tanggal belum diatur</p>
                                @endif
                                <a href="{{ $recording->youtube_url }}" target="_blank" class="mt-1 inline-flex items-center text-xs font-medium text-indigo-600 hover:text-indigo-800">
                                    Lihat di YouTube
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                @if($recording->is_published)
                                    <span class="inline-flex items-center rounded-full bg-emerald-100 px-2.5 py-0.5 text-xs font-semibold text-emerald-700">
                                        Published
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-full bg-yellow-100 px-2.5 py-0.5 text-xs font-semibold text-yellow-700">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('admin.recordings.edit', $recording) }}" class="text-indigo-600 hover:text-indigo-800">Edit</a>
                                    <form action="{{ route('admin.recordings.destroy', $recording) }}" method="POST" onsubmit="return confirm('Hapus rekaman ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-600 hover:text-rose-800">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-6 text-center text-sm text-gray-500">
                                Belum ada rekaman bootcamp yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="border-t border-gray-100 bg-gray-50 px-6 py-4">
            {{ $recordings->links() }}
        </div>
    </div>
</div>
@endsection
