@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-background">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-red-100 mb-6">
                <svg class="h-12 w-12 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            
            <h1 class="text-3xl font-bold text-foreground sm:text-4xl">
                Payment Failed
            </h1>
            <p class="mt-3 text-lg text-muted-foreground max-w-2xl mx-auto">
                Unfortunately, your payment could not be processed. Please try again or contact support.
            </p>
            
            <div class="mt-10 bg-card rounded-lg shadow-md p-6 max-w-2xl mx-auto">
                <h2 class="text-xl font-semibold text-foreground mb-4">What would you like to do?</h2>
                
                <div class="space-y-4">
                    <p class="text-muted-foreground">
                        Your enrollment has not been completed. You can try the payment again or contact our support team for assistance.
                    </p>
                    
                    <div class="mt-6 p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                        <p class="text-sm text-yellow-800">
                            <strong>Note:</strong> If you believe this is an error, please contact our support team with your order details.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="mt-10 flex flex-col sm:flex-row justify-center gap-4">
                <x-public.button href="{{ route('public.dashboard') }}" variant="primary" class="px-6 py-3">
                    Go to Dashboard
                </x-public.button>
                <x-public.button href="mailto:support@bootcamp.com" variant="secondary" class="px-6 py-3">
                    Contact Support
                </x-public.button>
            </div>
        </div>
    </div>
</div>
@endsection