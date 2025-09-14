@extends('layouts.admin')

@section('title', 'Edit Enrollment')

@section('content')
<div class="px-6 py-8">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Enrollment</h1>
            <p class="text-gray-600">Edit informasi enrollment.</p>
        </div>
        <a href="{{ route('admin.enrollments.index') }}" 
           class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg transition duration-200">
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">Formulir Edit Enrollment</h2>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.enrollments.update', $enrollment) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">User</label>
                        <select name="user_id" id="user_id" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id', $enrollment->user_id) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="batch_id" class="block text-sm font-medium text-gray-700 mb-1">Batch</label>
                        <select name="batch_id" id="batch_id" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @foreach($batches as $batch)
                                <option value="{{ $batch->id }}" {{ old('batch_id', $enrollment->batch_id) == $batch->id ? 'selected' : '' }}>
                                    {{ $batch->code }} - {{ $batch->bootcamp->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('batch_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="referral_id" class="block text-sm font-medium text-gray-700 mb-1">Referral (Optional)</label>
                        <select name="referral_id" id="referral_id" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="">Pilih Referral</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('referral_id', $enrollment->referral_id) == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        @error('referral_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" id="status" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value="pending" {{ old('status', $enrollment->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ old('status', $enrollment->status) == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="cancelled" {{ old('status', $enrollment->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            <option value="completed" {{ old('status', $enrollment->status) == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                        @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex items-center justify-end gap-x-4">
                    <button type="submit" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition duration-200">
                        Update Enrollment
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection