@extends('layouts.admin')

@section('title', 'Email Notification Settings')

@section('content')
<div class="px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Email Notifications</h1>
            <p class="text-gray-600">Atur SMTP Mailketing dan konfigurasi API untuk pemberitahuan email.</p>
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

    <form action="{{ route('admin.settings.email.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
            <div class="bg-white rounded-lg shadow overflow-hidden" x-data="{ enabled: {{ $settings['enabled'] ? 'true' : 'false' }} }">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">SMTP Mailketing</h2>
                </div>
                <div class="p-6 space-y-6">
                    <div class="flex items-center">
                        <input type="hidden" name="enabled" :value="enabled ? 1 : 0">
                        <button type="button" @click="enabled = ! enabled"
                                class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus-visible:ring focus-visible:ring-indigo-500 focus-visible:ring-offset-2"
                                :class="enabled ? 'bg-indigo-600' : 'bg-gray-200'">
                            <span class="sr-only">Aktifkan Email</span>
                            <span aria-hidden="true" class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow transition duration-200 ease-in-out" :class="enabled ? 'translate-x-5' : 'translate-x-0'"></span>
                        </button>
                        <span class="ml-3 text-sm text-gray-700" x-text="enabled ? 'Email notifikasi aktif' : 'Email notifikasi nonaktif'"></span>
                    </div>

                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label for="smtp_host" class="block text-sm font-medium text-gray-700 mb-1">Host</label>
                            <input type="text" name="smtp_host" id="smtp_host" value="{{ old('smtp_host', $settings['smtp_host']) }}"
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('smtp_host')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="smtp_port" class="block text-sm font-medium text-gray-700 mb-1">Port</label>
                            <input type="number" name="smtp_port" id="smtp_port" value="{{ old('smtp_port', $settings['smtp_port']) }}"
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="587">
                            @error('smtp_port')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="smtp_username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                            <input type="text" name="smtp_username" id="smtp_username" value="{{ old('smtp_username', $settings['smtp_username']) }}"
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('smtp_username')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="smtp_password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                            <input type="text" name="smtp_password" id="smtp_password" value="{{ old('smtp_password', $settings['smtp_password']) }}"
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('smtp_password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="from_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Pengirim</label>
                            <input type="text" name="from_name" id="from_name" value="{{ old('from_name', $settings['from_name']) }}"
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('from_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="from_address" class="block text-sm font-medium text-gray-700 mb-1">Email Pengirim</label>
                            <input type="email" name="from_address" id="from_address" value="{{ old('from_address', $settings['from_address']) }}"
                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="no-reply@mailketing.co.id">
                            @error('from_address')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">Mailketing API</h2>
                    <p class="mt-1 text-sm text-gray-500">Opsional &mdash; gunakan jika memanfaatkan API Mailketing untuk kampanye otomatis.</p>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label for="api_endpoint" class="block text-sm font-medium text-gray-700 mb-1">API Endpoint</label>
                        <input type="url" name="api_endpoint" id="api_endpoint" value="{{ old('api_endpoint', $settings['api_endpoint']) }}"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="https://api.mailketing.co.id/v1/...">
                        @error('api_endpoint')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="api_login" class="block text-sm font-medium text-gray-700 mb-1">API Login</label>
                        <input type="text" name="api_login" id="api_login" value="{{ old('api_login', $settings['api_login']) }}"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('api_login')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="api_token" class="block text-sm font-medium text-gray-700 mb-1">API Token</label>
                        <input type="text" name="api_token" id="api_token" value="{{ old('api_token', $settings['api_token']) }}"
                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('api_token')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end">
            <button type="submit" class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700">Simpan Pengaturan</button>
        </div>
    </form>

    <div class="mt-10 bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Template Pesan Email</h2>
            <p class="mt-1 text-sm text-gray-500">Aktif/nonaktifkan serta sesuaikan isi email untuk berbagai notifikasi sistem.</p>
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
                                <a href="{{ route('admin.settings.email.templates.edit', $template) }}"
                                   class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            </div>
                        </div>
                        <div class="border-t border-gray-200 bg-gray-50 px-5 py-3 text-sm text-gray-700">
                            <strong>Subject:</strong> {{ $template->subject }}
                        </div>
                        <div class="border-t border-gray-200 bg-gray-50 rounded-b-lg px-5 py-4 text-sm text-gray-700 whitespace-pre-wrap">
                            {{ $template->content }}
                        </div>
                    </div>
                @empty
                    <div class="col-span-2 py-8 text-center text-sm text-gray-500 border border-dashed border-gray-200 rounded-lg">
                        Belum ada template email yang tersedia.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
