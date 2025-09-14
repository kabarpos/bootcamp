@extends('layouts.admin')

@section('title', 'Edit Order')

@section('content')
<div class="px-4 sm:px-6 lg:px-8">
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-gray-900">Edit Order</h1>
            <p class="mt-2 text-sm text-gray-700">Edit informasi order "{{ $order->invoice_no }}".</p>
        </div>
    </div>

    <div class="mt-8 bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="enrollment_id" class="block text-sm font-medium text-gray-700">Enrollment</label>
                        <select name="enrollment_id" id="enrollment_id" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @foreach($enrollments as $enrollment)
                                <option value="{{ $enrollment->id }}" {{ old('enrollment_id', $order->enrollment_id) == $enrollment->id ? 'selected' : '' }}>
                                    {{ $enrollment->user->name }} - {{ $enrollment->batch->code }} ({{ $enrollment->batch->bootcamp->title }})
                                </option>
                            @endforeach
                        </select>
                        @error('enrollment_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700">Amount (Rp)</label>
                        <input type="number" name="amount" id="amount" 
                               value="{{ old('amount', $order->amount) }}"
                               step="0.01"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('amount')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="voucher_id" class="block text-sm font-medium text-gray-700">Voucher (Optional)</label>
                        <select name="voucher_id" id="voucher_id" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">Pilih Voucher</option>
                            @foreach($vouchers as $voucher)
                                <option value="{{ $voucher->id }}" {{ old('voucher_id', $order->voucher_id) == $voucher->id ? 'selected' : '' }}>
                                    {{ $voucher->code }} ({{ $voucher->type == 'percentage' ? $voucher->value.'%' : 'Rp '.$voucher->value }})
                                </option>
                            @endforeach
                        </select>
                        @error('voucher_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="pending" {{ old('status', $order->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ old('status', $order->status) == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="cancelled" {{ old('status', $order->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="expired" {{ old('status', $order->status) == 'expired' ? 'selected' : '' }}>Expired</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="expired_at" class="block text-sm font-medium text-gray-700">Expired At</label>
                        <input type="datetime-local" name="expired_at" id="expired_at" 
                               value="{{ old('expired_at', $order->expired_at ? $order->expired_at->format('Y-m-d\TH:i') : '') }}"
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        @error('expired_at')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <a href="{{ route('admin.orders.index') }}" class="text-sm font-semibold leading-6 text-gray-900">
                        Batal
                    </a>
                    <button type="submit" 
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection