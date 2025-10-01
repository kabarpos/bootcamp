<?php

namespace App\Providers;

use App\Repositories\Contracts\BatchRepositoryInterface;
use App\Repositories\Contracts\BlogPostRepositoryInterface;
use App\Repositories\Contracts\BootcampRepositoryInterface;
use App\Repositories\Contracts\EnrollmentRepositoryInterface;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Repositories\Contracts\SettingRepositoryInterface;
use App\Repositories\Eloquent\EloquentBatchRepository;
use App\Repositories\Eloquent\EloquentBlogPostRepository;
use App\Repositories\Eloquent\EloquentBootcampRepository;
use App\Repositories\Eloquent\EloquentEnrollmentRepository;
use App\Repositories\Eloquent\EloquentOrderRepository;
use App\Repositories\Eloquent\EloquentPaymentRepository;
use App\Repositories\Eloquent\EloquentSettingRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(BootcampRepositoryInterface::class, EloquentBootcampRepository::class);
        $this->app->bind(BatchRepositoryInterface::class, EloquentBatchRepository::class);
        $this->app->bind(BlogPostRepositoryInterface::class, EloquentBlogPostRepository::class);
        $this->app->bind(SettingRepositoryInterface::class, EloquentSettingRepository::class);
        $this->app->bind(EnrollmentRepositoryInterface::class, EloquentEnrollmentRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, EloquentOrderRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, EloquentPaymentRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
