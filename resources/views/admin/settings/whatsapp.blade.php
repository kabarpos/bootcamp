@extends('layouts.admin')

@section('title', 'WhatsApp Notification Settings')

@section('content')
<div class="px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">WhatsApp Notifications</h1>
            <p class="text-gray-600">Kelola integrasi WhatsApp melalui Dripsender dan template pesan.</p>
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

    <div class="bg-white rounded-lg shadow overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Konfigurasi API</h2>
        </div>
        <div x-data="{ enabled: {{ $settings['enabled'] ? 'true' : 'false' }} }" class="p-6">
            <form action="{{ route('admin.settings.whatsapp.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="flex items-center">
                    <input type="hidden" name="enabled" :value="enabled ? 1 : 0">
                    <button type="button" @click="enabled = ! enabled"
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus-visible:ring focus-visible:ring-indigo-500 focus-visible:ring-offset-2"
                            :class="enabled ? 'bg-indigo-600' : 'bg-gray-200'">
                        <span class="sr-only">Aktifkan WhatsApp</span>
                        <span aria-hidden="true" class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow transition duration-200 ease-in-out" :class="enabled ? 'translate-x-5' : 'translate-x-0'"></span>
                    </button>
                    <span class="ml-3 text-sm text-gray-700" x-text="enabled ? 'WhatsApp Notifikasi Aktif' : 'WhatsApp Notifikasi Nonaktif'"></span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="api_key" class="block text-sm font-medium text-gray-700 mb-1">API Key</label>
                        <input type="text" name="api_key" id="api_key" value="{{ old('api_key', $settings['api_key']) }}"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <p class="mt-2 text-xs text-gray-500">Gunakan API Key dari Dripsender Dashboard.</p>
                    </div>
                    <div>
                        <label for="sender_number" class="block text-sm font-medium text-gray-700 mb-1">Nomor Pengirim</label>
                        <input type="text" name="sender_number" id="sender_number" value="{{ old('sender_number', $settings['sender_number']) }}"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="62xxxxxxxxxxx">
                        <p class="mt-2 text-xs text-gray-500">Nomor pengirim yang telah terdaftar di Dripsender.</p>
                    </div>
                    <div>
                        <label for="api_base_url" class="block text-sm font-medium text-gray-700 mb-1">API Base URL</label>
                        <input type="url" name="api_base_url" id="api_base_url" value="{{ old('api_base_url', $settings['api_base_url']) }}"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="https://app.dripsender.id/api/v1">
                    </div>
                    <div>
                        <label for="webhook_token" class="block text-sm font-medium text-gray-700 mb-1">Webhook Token</label>
                        <input type="text" name="webhook_token" id="webhook_token" value="{{ old('webhook_token', $settings['webhook_token']) }}"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <p class="mt-2 text-xs text-gray-500">Token rahasia untuk verifikasi request webhook.</p>
                    </div>
                </div>

                <div class="flex items-center justify-end">
                    <button type="submit"
                            class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">Simpan Pengaturan</button>
                </div>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Template Pesan</h2>
            <p class="mt-1 text-sm text-gray-500">Gunakan placeholder sesuai kebutuhan seperti <code>{{ '{name}' }}</code>, <code>{{ '{invoice_no}' }}</code>, dll.</p>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            @forelse($templates as $template)
                <div class="rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition">
                    <div class="px-5 py-4 flex items-start justify-between gap-4">
                        <div class="min-w-0">
                            <h3 class="text-lg font-semibold text-gray-800 truncate">{{ $template->name }}</h3>
                            <p class="mt-1 text-sm text-gray-500">Kode: {{ $template->key }}</p>
                            <p class="mt-1 text-sm text-gray-500">Placeholder: {{ implode(', ', $template->requiredPlaceholders()) ?: '-' }}</p>
                        </div>
                        <div class="flex items-center gap-3 flex-shrink-0">
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $template->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                                {{ $template->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                            <a href="{{ route('admin.settings.whatsapp.templates.edit', $template) }}"
                               class="text-indigo-600 hover:text-indigo-900">Edit</a>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 bg-gray-50 rounded-b-lg px-5 py-4 text-sm text-gray-700 whitespace-pre-wrap">
                        {{ $template->content }}
                    </div>
                </div>
            @empty
                <div class="col-span-2 py-8 text-center text-sm text-gray-500 border border-dashed border-gray-200 rounded-lg">
                    Belum ada template yang tersedia.
                </div>
            @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
