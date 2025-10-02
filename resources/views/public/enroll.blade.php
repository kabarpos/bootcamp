@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-background">
    <x-public.breadcrumb :items="[
        ['label' => 'Home', 'url' => route('public.homepage')],
        ['label' => 'Bootcamps', 'url' => route('public.bootcamps')],
        ['label' => $bootcamp->title, 'url' => route('public.bootcamp', $bootcamp->slug)],
        ['label' => 'Enroll', 'url' => '#']
    ]" />
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-bold text-foreground sm:text-4xl">
                Enroll in {{ $bootcamp->title }}
            </h1>
            <p class="mt-3 text-lg text-muted-foreground">
                Select a batch to begin your journey
            </p>
        </div>
        
        <div class="bg-card rounded-lg shadow-md p-6 mb-8">
            <h2 class="text-xl font-semibold text-foreground mb-4">Bootcamp Details</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <p class="text-sm text-muted-foreground">Program</p>
                    <p class="font-medium">{{ $bootcamp->title }}</p>
                </div>
                <div>
                    <p class="text-sm text-muted-foreground">Level</p>
                    <p class="font-medium">{{ ucfirst($bootcamp->level) }}</p>
                </div>
                <div>
                    <p class="text-sm text-muted-foreground">Duration</p>
                    <p class="font-medium">{{ $bootcamp->duration_hours }} hours</p>
                </div>
            </div>
        </div>
        
        <form action="{{ route('payment.process', $bootcamp->slug) }}" method="POST">
            @csrf
            
            <div class="bg-card rounded-lg shadow-md p-6 mb-8">
                <h2 class="text-xl font-semibold text-foreground mb-4">Select Batch</h2>
                
                @if($batches->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-muted-foreground">No batches available for this bootcamp at the moment.</p>
                        <p class="mt-2 text-sm text-muted-foreground">Please check back later or contact us for more information.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($batches as $batch)
                            <label for="batch_{{ $batch->id }}" class="block cursor-pointer">
                                <input type="radio" name="batch_id" value="{{ $batch->id }}" id="batch_{{ $batch->id }}" class="sr-only peer" required>
                                <div class="border border-border rounded-lg p-4 cursor-pointer transition-all duration-200 hover:border-primary hover:shadow-sm peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:shadow-md peer-focus-visible:outline-none peer-focus-visible:ring-2 peer-focus-visible:ring-primary/40">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="font-medium text-foreground">{{ $batch->code }}</h3>
                                            <p class="text-sm text-muted-foreground mt-1">
                                                {{ $batch->start_date->format('M d, Y') }} - {{ $batch->end_date->format('M d, Y') }}
                                            </p>
                                        </div>
                                        <div class="bg-primary/10 text-primary text-xs font-medium px-2 py-1 rounded">
                                            {{ ucfirst($batch->status) }}
                                        </div>
                                    </div>
                                    
                                    <div class="mt-3 flex items-center text-sm">
                                        <svg class="h-4 w-4 text-muted-foreground mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span class="text-muted-foreground">
                                            @if($batch->city)
                                                {{ $batch->city->name }}
                                            @else
                                                Online
                                            @endif
                                        </span>
                                    </div>
                                    
                                    <div class="mt-2 flex justify-between items-center">
                                        <span class="text-sm text-muted-foreground">
                                            {{ $batch->available_slots }} slots available
                                        </span>
                                        <span class="font-medium text-foreground">
                                            Rp {{ number_format($bootcamp->base_price, 0, ',', '.') }}
                                        </span>
                                    </div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                    
                    @error('batch_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                @endif
            </div>
            
            @if(!$batches->isEmpty())
                <div class="bg-card rounded-lg shadow-md p-6 mb-8">
                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox" class="focus:ring-primary h-4 w-4 text-primary border-border rounded" required>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-medium text-foreground">I agree to the terms and conditions</label>
                            <p class="text-muted-foreground">
                                By enrolling, you agree to our <a href="#" class="text-primary hover:underline">Terms of Service</a> and <a href="#" class="text-primary hover:underline">Privacy Policy</a>.
                            </p>
                            
                            @error('terms')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-end">
                    <x-public.button type="submit" variant="primary" class="px-8 py-3">
                        Proceed to Payment
                    </x-public.button>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection