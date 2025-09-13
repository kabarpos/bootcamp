<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Admin Routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin',
])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Bootcamp Management
    Route::resource('bootcamps', App\Http\Controllers\Admin\BootcampController::class);
    Route::resource('batches', App\Http\Controllers\Admin\BatchController::class);
    
    // User Management
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class);
    
    // Other Resources
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class);
    Route::resource('enrollments', App\Http\Controllers\Admin\EnrollmentController::class);
    Route::resource('certificates', App\Http\Controllers\Admin\CertificateController::class);
});
