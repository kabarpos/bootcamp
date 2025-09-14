@extends('layouts.admin')

@section('title', 'Certificates')

@section('content')
<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Certificates</h1>
            <p class="mt-2 text-sm text-gray-700">Daftar semua sertifikat dalam sistem.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <a href="{{ route('admin.certificates.create') }}" 
               class="inline-flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 sm:w-auto">
                Tambah Certificate
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="mt-6 flex flex-col md:flex-row gap-4">
        <form method="GET" class="flex-1">
            <div class="flex rounded-md shadow-sm">
                <input type="text" name="search" value="{{ request('search') }}" 
                       placeholder="Cari sertifikat..." 
                       class="block w-full min-w-0 flex-1 rounded-none rounded-l-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <button type="submit" 
                        class="relative -ml-px inline-flex items-center gap-x-1.5 rounded-r-md px-3 py-2 text-sm font-semibold text-gray-900 border border-gray-300 hover:bg-gray-50">
                    Cari
                </button>
            </div>
        </form>
        
        <form method="GET" class="flex">
            <select name="batch" onchange="this.form.submit()" 
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">Semua Batch</option>
                @foreach($batches as $batch)
                    <option value="{{ $batch->id }}" {{ request('batch') == $batch->id ? 'selected' : '' }}>
                        {{ $batch->code }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- Certificates Table -->
    <div class="mt-8 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Certificate No</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">User</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Bootcamp</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Tanggal</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse($certificates as $certificate)
                                <tr>
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                        {{ $certificate->certificate_no }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $certificate->enrollment->user->name ?? 'N/A' }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $certificate->enrollment->batch->bootcamp->title ?? 'N/A' }}
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        @if($certificate->isIssued())
                                            <span class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">
                                                Issued
                                            </span>
                                        @else
                                            <span class="inline-flex rounded-full bg-yellow-100 px-2 text-xs font-semibold leading-5 text-yellow-800">
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                        {{ $certificate->created_at->format('d M Y') }}
                                    </td>
                                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                        <a href="{{ route('admin.certificates.show', $certificate) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
                                        <a href="{{ route('admin.certificates.edit', $certificate) }}" class="ml-4 text-indigo-600 hover:text-indigo-900">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-4 text-center text-sm text-gray-500">
                                        Tidak ada sertifikat ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $certificates->links() }}
    </div>
</div>
@endsection