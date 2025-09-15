<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\BootcampController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;

// Public routes
Route::get('/', [PublicController::class, 'index'])->name('public.homepage');
Route::get('/about', [PublicController::class, 'about'])->name('public.about');
Route::get('/contact', [PublicController::class, 'contact'])->name('public.contact');
Route::get('/bootcamps', [PublicController::class, 'bootcamps'])->name('public.bootcamps');
Route::get('/bootcamp/{slug}', [PublicController::class, 'bootcamp'])->name('public.bootcamp');

// Protected routes that require email verification
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/user/dashboard', [PublicController::class, 'dashboard'])->name('public.dashboard');
    Route::get('/bootcamp/{slug}/resources', [PublicController::class, 'resources'])->name('public.resources');
    Route::get('/bootcamp/{slug}/assessments', [PublicController::class, 'assessments'])->name('public.assessments');
    Route::get('/bootcamp/{slug}/projects', [PublicController::class, 'projects'])->name('public.projects');
    
    // Blog post route
    Route::get('/blog/{slug}', function($slug) {
        $post = \App\Models\BlogPost::where('slug', $slug)->firstOrFail();
        return view('public.blog-post', compact('post'));
    })->name('public.blog.post');
    
    // Payment routes
    Route::get('/bootcamp/{slug}/enroll', [PaymentController::class, 'enroll'])->name('payment.enroll');
    Route::post('/bootcamp/{slug}/enroll', [PaymentController::class, 'processEnrollment'])->name('payment.process');
    Route::get('/checkout/{orderId}', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success.redirect');
    Route::get('/payment/success/{orderId}', [PaymentController::class, 'successPage'])->name('payment.success');
    Route::get('/payment/failure', [PaymentController::class, 'failure'])->name('payment.failure');
    Route::post('/payment/notification', [PaymentController::class, 'notification'])->name('payment.notification');
});

// Admin routes
Route::middleware(['auth:sanctum', 'verified', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Resource routes for admin controllers with proper naming
    Route::resource('/admin/orders', OrderController::class)->names([
        'index' => 'admin.orders.index',
        'create' => 'admin.orders.create',
        'store' => 'admin.orders.store',
        'show' => 'admin.orders.show',
        'edit' => 'admin.orders.edit',
        'update' => 'admin.orders.update',
        'destroy' => 'admin.orders.destroy',
    ]);
    
    Route::resource('/admin/bootcamps', BootcampController::class)->names([
        'index' => 'admin.bootcamps.index',
        'create' => 'admin.bootcamps.create',
        'store' => 'admin.bootcamps.store',
        'show' => 'admin.bootcamps.show',
        'edit' => 'admin.bootcamps.edit',
        'update' => 'admin.bootcamps.update',
        'destroy' => 'admin.bootcamps.destroy',
    ]);
    
    Route::resource('/admin/certificates', CertificateController::class)->names([
        'index' => 'admin.certificates.index',
        'create' => 'admin.certificates.create',
        'store' => 'admin.certificates.store',
        'show' => 'admin.certificates.show',
        'edit' => 'admin.certificates.edit',
        'update' => 'admin.certificates.update',
        'destroy' => 'admin.certificates.destroy',
    ]);
    
    Route::resource('/admin/enrollments', EnrollmentController::class)->names([
        'index' => 'admin.enrollments.index',
        'create' => 'admin.enrollments.create',
        'store' => 'admin.enrollments.store',
        'show' => 'admin.enrollments.show',
        'edit' => 'admin.enrollments.edit',
        'update' => 'admin.enrollments.update',
        'destroy' => 'admin.enrollments.destroy',
    ]);
    
    Route::resource('/admin/batches', BatchController::class)->names([
        'index' => 'admin.batches.index',
        'create' => 'admin.batches.create',
        'store' => 'admin.batches.store',
        'show' => 'admin.batches.show',
        'edit' => 'admin.batches.edit',
        'update' => 'admin.batches.update',
        'destroy' => 'admin.batches.destroy',
    ]);
    
    Route::resource('/admin/users', UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'show' => 'admin.users.show',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
    
    // Custom user actions
    Route::post('/admin/users/{user}/verify-email', [UserController::class, 'verifyEmail'])->name('admin.users.verify-email');
    Route::post('/admin/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('admin.users.reset-password');
    Route::post('/admin/users/{user}/assign-role', [UserController::class, 'assignRole'])->name('admin.users.assign-role');
    Route::post('/admin/users/{user}/remove-role', [UserController::class, 'removeRole'])->name('admin.users.remove-role');
    
    Route::resource('/admin/roles', RoleController::class)->names([
        'index' => 'admin.roles.index',
        'create' => 'admin.roles.create',
        'store' => 'admin.roles.store',
        'show' => 'admin.roles.show',
        'edit' => 'admin.roles.edit',
        'update' => 'admin.roles.update',
        'destroy' => 'admin.roles.destroy',
    ]);
});

// Auth routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});