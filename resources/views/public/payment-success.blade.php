@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-background">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-green-100 mb-6">
                <svg class="h-12 w-12 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            
            <h1 class="text-3xl font-bold text-foreground sm:text-4xl">
                Payment Successful!
            </h1>
            <p class="mt-3 text-lg text-muted-foreground max-w-2xl mx-auto">
                Thank you for your payment. Your enrollment is now confirmed.
            </p>
            
            <div class="mt-10 bg-card rounded-lg shadow-md p-6 max-w-2xl mx-auto">
                <h2 class="text-xl font-semibold text-foreground mb-4">Order Details</h2>
                
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <div>
                            <p class="font-medium">{{ $order->enrollment->batch->bootcamp->title }}</p>
                            <p class="text-sm text-muted-foreground">
                                Batch: {{ $order->enrollment->batch->code }}
                            </p>
                            <p class="text-sm text-muted-foreground">
                                {{ $order->enrollment->batch->start_date->format('M d, Y') }} - {{ $order->enrollment->batch->end_date->format('M d, Y') }}
                            </p>
                        </div>
                        <p class="font-medium">
                            Rp {{ number_format($order->total, 0, ',', '.') }}
                        </p>
                    </div>
                    
                    <div class="flex justify-between border-t border-border pt-4">
                        <p class="font-medium">Order ID</p>
                        <p class="font-medium">
                            {{ $order->invoice_no }}
                        </p>
                    </div>
                    
                    <div class="flex justify-between">
                        <p class="font-medium">Payment Status</p>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                            Paid
                        </span>
                    </div>
                </div>
                
                <div class="mt-6 p-4 bg-primary/5 rounded-lg">
                    <p class="text-sm text-muted-foreground">
                        A confirmation email has been sent to {{ $order->enrollment->user->email }}.
                    </p>
                </div>
            </div>
            
            <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
                <x-public.button href="{{ route('public.dashboard') }}" variant="primary" class="px-6 py-3">
                    Go to Dashboard
                </x-public.button>
                <x-public.button href="{{ route('public.bootcamp', $order->enrollment->batch->bootcamp->slug) }}" variant="secondary" class="px-6 py-3">
                    View Bootcamp Details
                </x-public.button>
            </div>
        </div>
    </div>
</div>
@endsection