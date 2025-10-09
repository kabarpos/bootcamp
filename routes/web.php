<?php

use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\BootcampController as AdminBootcampController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// Public marketing pages
Route::get('/', [PublicController::class, 'index'])->name('public.homepage');
Route::get('/about', [PublicController::class, 'about'])->name('public.about');
Route::get('/contact', [PublicController::class, 'contact'])->name('public.contact');
Route::get('/bootcamps', [PublicController::class, 'bootcamps'])->name('public.bootcamps');
Route::get('/bootcamps/{slug}', [PublicController::class, 'bootcamp'])->name('public.bootcamp');
Route::get('/bootcamps/{slug}/resources', [PublicController::class, 'resources'])
    ->middleware(['auth', 'verified'])
    ->name('public.resources');
Route::get('/bootcamps/{slug}/assessments', [PublicController::class, 'assessments'])->name('public.assessments');
Route::get('/bootcamps/{slug}/projects', [PublicController::class, 'projects'])->name('public.projects');

// Authenticated student area & payment flow
Route::middleware(['auth', 'verified'])->group(function (): void {
    Route::get('/student/dashboard', [PublicController::class, 'dashboard'])->name('public.dashboard');
    Route::get('/student/bootcamps/{enrollment}', [PublicController::class, 'enrollmentDetail'])
        ->name('student.enrollments.show');

    Route::get('/bootcamps/{slug}/enroll', [PaymentController::class, 'enroll'])->name('payment.enroll');
    Route::post('/bootcamps/{slug}/enroll', [PaymentController::class, 'processEnrollment'])->name('payment.process');
    Route::get('/payment/checkout/{order}', [PaymentController::class, 'checkout'])->name('payment.checkout');
    Route::get('/payment/success/{order}', [PaymentController::class, 'successPage'])->name('payment.success');
    Route::get('/payment/failure', [PaymentController::class, 'failure'])->name('payment.failure');
    Route::get('/payment/finish', [PaymentController::class, 'success'])->name('payment.success.redirect');
});

// Midtrans webhook (CSRF exemption configured in bootstrap/app.php)
Route::post('/payment/notification', [PaymentController::class, 'notification'])->name('payment.notification');

// Administration area
Route::middleware(['auth', 'verified', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function (): void {
        Route::redirect('/', '/admin/dashboard');
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::resource('bootcamps', AdminBootcampController::class);
        Route::patch('bootcamps/{bootcamp}/toggle-status', [AdminBootcampController::class, 'toggleStatus'])
            ->name('bootcamps.toggle-status');

        Route::resource('batches', BatchController::class);
        Route::patch('batches/{batch}/status', [BatchController::class, 'updateStatus'])->name('batches.update-status');
        Route::get('batches/by-bootcamp', [BatchController::class, 'getByBootcamp'])->name('batches.by-bootcamp');

        Route::resource('enrollments', EnrollmentController::class);
        Route::patch('enrollments/{enrollment}/status', [EnrollmentController::class, 'updateStatus'])
            ->name('enrollments.update-status');
        Route::post('enrollments/bulk-status', [EnrollmentController::class, 'bulkUpdateStatus'])
            ->name('enrollments.bulk-update-status');
        Route::get('enrollments/export/csv', [EnrollmentController::class, 'export'])->name('enrollments.export');
        Route::get('enrollments/by-batch', [EnrollmentController::class, 'getByBatch'])->name('enrollments.by-batch');
        Route::get('enrollments/statistics', [EnrollmentController::class, 'statistics'])->name('enrollments.statistics');

        Route::resource('certificates', CertificateController::class);
        Route::post('certificates/{certificate}/issue', [CertificateController::class, 'issue'])->name('certificates.issue');
        Route::post('certificates/{certificate}/revoke', [CertificateController::class, 'revoke'])->name('certificates.revoke');
        Route::post('certificates/{certificate}/regenerate', [CertificateController::class, 'regenerate'])
            ->name('certificates.regenerate');
        Route::post('certificates/{enrollment}/generate', [CertificateController::class, 'generate'])
            ->name('certificates.generate');
        Route::post('certificates/bulk/generate', [CertificateController::class, 'generateForCompletedEnrollments'])
            ->name('certificates.generate-bulk');
        Route::get('certificates/{certificate}/download', [CertificateController::class, 'download'])->name('certificates.download');
        Route::get('certificates/export/csv', [CertificateController::class, 'export'])->name('certificates.export');
        Route::get('certificates/statistics', [CertificateController::class, 'statistics'])->name('certificates.statistics');

        Route::resource('orders', OrderController::class);
        Route::get('orders/export/csv', [OrderController::class, 'export'])->name('orders.export');
        Route::get('orders/statistics', [OrderController::class, 'getStatistics'])->name('orders.statistics');

        Route::post('users/{user}/verify-email', [UserController::class, 'verifyEmail'])->name('users.verify-email');
        Route::resource('permissions', PermissionController::class)->except(['show']);
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);
    });





