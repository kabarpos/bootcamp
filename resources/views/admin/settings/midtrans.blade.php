@extends('layouts.admin')

@section('title', 'Midtrans Settings')

@section('content')
<div class="px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Midtrans Settings</h1>
            <p class="text-gray-600">Kelola konfigurasi Midtrans termasuk mode sandbox dan production.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-md bg-green-50 p-4 border border-green-200">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414L8.414 15l-4.121-4.121a1 1 0 011.414-1.414L8.414 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Konfigurasi Midtrans</h2>
        </div>
        <div class="p-6" x-data="{ mode: '{{ old('mode', $settings['mode']) }}' }">
            <form action="{{ route('admin.settings.midtrans.update') }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Mode</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="flex items-start gap-3 rounded-lg border p-4 cursor-pointer"
                               :class="mode === 'sandbox' ? 'border-indigo-500 ring-2 ring-indigo-200' : 'border-gray-200 hover:border-indigo-300'">
                            <input type="radio" name="mode" value="sandbox" x-model="mode"
                                   class="mt-1 h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                            <div>
                                <span class="block text-sm font-semibold text-gray-900">Sandbox / Testing</span>
                                <span class="mt-1 block text-sm text-gray-500">Gunakan kredensial sandbox untuk pengujian.</span>
                            </div>
                        </label>
                        <label class="flex items-start gap-3 rounded-lg border p-4 cursor-pointer"
                               :class="mode === 'production' ? 'border-indigo-500 ring-2 ring-indigo-200' : 'border-gray-200 hover:border-indigo-300'">
                            <input type="radio" name="mode" value="production" x-model="mode"
                                   class="mt-1 h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                            <div>
                                <span class="block text-sm font-semibold text-gray-900">Production</span>
                                <span class="mt-1 block text-sm text-gray-500">Gunakan kredensial live untuk transaksi nyata.</span>
                            </div>
                        </label>
                    </div>
                    @error('mode')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Sandbox Credentials</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="sandbox_server_key" class="block text-sm font-medium text-gray-700 mb-1">Server Key (Sandbox)</label>
                                <input type="text" id="sandbox_server_key" name="sandbox_server_key"
                                       value="{{ old('sandbox_server_key', $settings['sandbox_server_key']) }}"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                       :required="mode === 'sandbox'">
                                @error('sandbox_server_key')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="sandbox_client_key" class="block text-sm font-medium text-gray-700 mb-1">Client Key (Sandbox)</label>
                                <input type="text" id="sandbox_client_key" name="sandbox_client_key"
                                       value="{{ old('sandbox_client_key', $settings['sandbox_client_key']) }}"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                       :required="mode === 'sandbox'">
                                @error('sandbox_client_key')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Production Credentials</h3>
                        <div class="space-y-4">
                            <div>
                                <label for="production_server_key" class="block text-sm font-medium text-gray-700 mb-1">Server Key (Production)</label>
                                <input type="text" id="production_server_key" name="production_server_key"
                                       value="{{ old('production_server_key', $settings['production_server_key']) }}"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                       :required="mode === 'production'">
                                @error('production_server_key')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="production_client_key" class="block text-sm font-medium text-gray-700 mb-1">Client Key (Production)</label>
                                <input type="text" id="production_client_key" name="production_client_key"
                                       value="{{ old('production_client_key', $settings['production_client_key']) }}"
                                       class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                                       :required="mode === 'production'">
                                @error('production_client_key')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3">
                    <button type="submit" class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 transition">
                        Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
