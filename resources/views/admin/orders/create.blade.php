@extends('layouts.admin')

@section('title', 'Tambah Order')

@section('content')
<div class="px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Tambah Order</h1>
            <p class="text-gray-600">Buat order baru untuk enrollment.</p>
        </div>
        <a href="{{ route('admin.orders.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Formulir Order Baru</h2>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.orders.store') }}" method="POST">
                @csrf
                
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="enrollment_id" class="block text-sm font-medium text-gray-700 mb-1">Enrollment</label>
                        <select name="enrollment_id" id="enrollment_id" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">Pilih Enrollment</option>
                            @foreach($enrollments as $enrollment)
                                <option value="{{ $enrollment->id }}" 
                                        {{ old('enrollment_id') == $enrollment->id ? 'selected' : '' }}>
                                    {{ $enrollment->user->name ?? 'N/A' }} - 
                                    {{ $enrollment->batch->bootcamp->title ?? 'N/A' }} - 
                                    {{ $enrollment->batch->code ?? 'N/A' }}
                                </option>
                            @endforeach
                        </select>
                        @error('enrollment_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Amount</label>
                        <input type="number" name="amount" id="amount" 
                               value="{{ old('amount') }}"
                               step="0.01"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="voucher_id" class="block text-sm font-medium text-gray-700 mb-1">Voucher (Opsional)</label>
                        <select name="voucher_id" id="voucher_id" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">Pilih Voucher</option>
                            @foreach($vouchers as $voucher)
                                <option value="{{ $voucher->id }}" 
                                        {{ old('voucher_id') == $voucher->id ? 'selected' : '' }}>
                                    {{ $voucher->code }} ({{ $voucher->type === 'percent' ? $voucher->value.'%' : 'Rp '.number_format($voucher->value, 0, ',', '.') }})
                                </option>
                            @endforeach
                        </select>
                        @error('voucher_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="status" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ old('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="expired" {{ old('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="expired_at" class="block text-sm font-medium text-gray-700 mb-1">Expired At (Opsional)</label>
                        <input type="datetime-local" name="expired_at" id="expired_at" 
                               value="{{ old('expired_at') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('expired_at')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-4">
                    <button type="submit" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition duration-200">
                        Simpan Order
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection