@extends('layouts.admin')

@section('title', 'Tambah Rekaman Bootcamp')

@section('content')
<div class="mx-auto max-w-4xl px-6 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Rekaman Bootcamp</h1>
        <p class="text-sm text-gray-600">Simpan tautan video YouTube untuk peserta batch yang terdaftar.</p>
    </div>

    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        <form method="POST" action="{{ route('admin.recordings.store') }}" class="space-y-6">
            @csrf

            <div>
                <label for="batch_id" class="block text-sm font-medium text-gray-700">Batch</label>
                <select id="batch_id" name="batch_id" required
                        class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Pilih batch</option>
                    @foreach($bootcamps as $bootcamp)
                        <optgroup label="{{ $bootcamp->title }}">
                            @forelse($bootcamp->batches as $batch)
                                <option value="{{ $batch->id }}" @selected(old('batch_id') == $batch->id)>
                                    {{ $batch->code }} — {{ optional($batch->start_date)->format('d M Y') ?? 'Tanpa tanggal' }}
                                </option>
                            @empty
                                <option disabled>Belum ada batch</option>
                            @endforelse
                        </optgroup>
                    @endforeach
                </select>
                @error('batch_id')
                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Judul Rekaman</label>
                <input id="title" type="text" name="title" value="{{ old('title') }}" required
                       class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('title')
                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="youtube_url" class="block text-sm font-medium text-gray-700">URL YouTube</label>
                <input id="youtube_url" type="url" name="youtube_url" value="{{ old('youtube_url') }}" required
                       placeholder="https://youtu.be/…" class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <p class="mt-1 text-xs text-gray-500">Gunakan tautan publik atau tidak terdaftar dari YouTube.</p>
                @error('youtube_url')
                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi (opsional)</label>
                <textarea id="description" name="description" rows="4"
                          class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid gap-4 md:grid-cols-3">
                <div>
                    <label for="recorded_at" class="block text-sm font-medium text-gray-700">Tanggal Rekaman</label>
                    <input id="recorded_at" type="datetime-local" name="recorded_at"
                           value="{{ old('recorded_at') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('recorded_at')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="position" class="block text-sm font-medium text-gray-700">Urutan</label>
                    <input id="position" type="number" name="position" min="0" value="{{ old('position', 0) }}"
                           class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    @error('position')
                        <p class="mt-1 text-sm text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center gap-2 pt-6">
                    <input id="is_published" type="checkbox" name="is_published" value="1" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                           {{ old('is_published', true) ? 'checked' : '' }}>
                    <label for="is_published" class="text-sm font-medium text-gray-700">Tampilkan ke peserta</label>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.recordings.index') }}" class="text-sm text-gray-500 hover:text-gray-700">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex items-center gap-2 rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700">
                    Simpan Rekaman
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
