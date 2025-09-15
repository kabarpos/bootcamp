<?php

use Illuminate\Support\Facades\Route;

// Simple test route
Route::get('/test', function () {
    return response()->json(['status' => 'OK']);
});

// Simple POST test route
Route::post('/test-post', function () {
    return response()->json(['status' => 'OK', 'received' => request()->all()]);
});

// Payment notification route (accessible without auth/CSRF)
Route::post('/payment/notification', function () {
    \Illuminate\Support\Facades\Log::info('Payment notification received', request()->all());
    return response()->json(['status' => 'OK']);
})->name('payment.notification');

// Your existing routes go here...