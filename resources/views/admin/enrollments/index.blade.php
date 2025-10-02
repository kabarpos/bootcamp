@extends('layouts.admin')

@section('title', 'Enrollments')

@section('content')
<div class="px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Enrollments</h1>
            <p class="text-gray-600">Daftar semua enrollment dalam sistem.</p>
        </div>
        <a href="{{ route('admin.enrollments.create') }}" 
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition duration-200">
            Tambah Enrollment
        </a>
    </div>

    @php($hasFilters = request()->filled('search') || request()->filled('status') || request()->filled('batch_id') || request()->filled('user_id') || request()->filled('start_date') || request()->filled('end_date'))

    <!-- Filters -->
    <div class="mb-6">
        <form method="GET" class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
            <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                <div class="md:col-span-2">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Pencarian</label>
                    <input id="search" type="text" name="search" value="{{ request('search') }}"
                           placeholder="Cari nama, email, kode batch..."
                           class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select id="status" name="status"
                            class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">Semua Status</option>
                        @foreach($statuses as $value => $label)
                            <option value="{{ $value }}" {{ request('status') === $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="batch_id" class="block text-sm font-medium text-gray-700 mb-1">Batch</label>
                    <select id="batch_id" name="batch_id"
                            class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">Semua Batch</option>
                        @foreach($batches as $batchOption)
                            <option value="{{ $batchOption->id }}" {{ (string) request('batch_id') === (string) $batchOption->id ? 'selected' : '' }}>{{ $batchOption->code }} - {{ $batchOption->bootcamp->title ?? 'Tanpa Bootcamp' }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">User</label>
                    <select id="user_id" name="user_id"
                            class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">Semua User</option>
                        @foreach($users as $userOption)
                            <option value="{{ $userOption->id }}" {{ (string) request('user_id') === (string) $userOption->id ? 'selected' : '' }}>{{ $userOption->name }} ({{ $userOption->email }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                    <input id="start_date" type="date" name="start_date" value="{{ request('start_date') }}"
                           class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Sampai</label>
                    <input id="end_date" type="date" name="end_date" value="{{ request('end_date') }}"
                           class="block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
            </div>
            <div class="mt-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div class="text-sm text-gray-500">
                    @if($hasFilters)
                        Menampilkan data sesuai filter yang dipilih.
                    @else
                        Menampilkan semua enrollment.
                    @endif
                </div>
                <div class="flex items-center gap-3 justify-end">
                    <a href="{{ route('admin.enrollments.index') }}"
                       class="text-sm text-gray-500 hover:text-gray-700">Reset</a>
                    <button type="submit"
                            class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 transition">Terapkan</button>
                </div>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bootcamp</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Batch</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($enrollments as $enrollment)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $enrollment->user->name ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $enrollment->batch->bootcamp->title ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $enrollment->batch->code ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                    @if($enrollment->status === 'confirmed') bg-green-100 text-green-800
                                    @elseif($enrollment->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($enrollment->status === 'completed') bg-blue-100 text-blue-800
                                    @elseif($enrollment->status === 'cancelled') bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($enrollment->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $enrollment->created_at->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.enrollments.show', $enrollment) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 mr-3">View</a>
                                <a href="{{ route('admin.enrollments.edit', $enrollment) }}" 
                                   class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                                <form action="{{ route('admin.enrollments.destroy', $enrollment) }}" 
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus enrollment ini?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                Tidak ada enrollment ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $enrollments->links() }}
    </div>
</div>
@endsection