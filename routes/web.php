<?php

use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [App\Http\Controllers\PublicController::class, 'index'])->name('public.homepage');
Route::get('/about', [App\Http\Controllers\PublicController::class, 'about'])->name('public.about');
Route::get('/contact', [App\Http\Controllers\PublicController::class, 'contact'])->name('public.contact');
Route::get('/bootcamps', [App\Http\Controllers\PublicController::class, 'bootcamps'])->name('public.bootcamps');
Route::get('/bootcamps/{slug}', [App\Http\Controllers\PublicController::class, 'bootcamp'])->name('public.bootcamp');

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
    
    // Certificate custom actions
    Route::patch('certificates/{certificate}/issue', [App\Http\Controllers\Admin\CertificateController::class, 'issue'])->name('certificates.issue');
    Route::patch('certificates/{certificate}/revoke', [App\Http\Controllers\Admin\CertificateController::class, 'revoke'])->name('certificates.revoke');
    Route::get('certificates/{certificate}/download', [App\Http\Controllers\Admin\CertificateController::class, 'download'])->name('certificates.download');
});