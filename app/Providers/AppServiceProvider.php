<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (app()->runningInConsole()) {
            return;
        }

        try {
            if (Schema::hasTable('setting')) {
                $mode = Setting::get('midtrans_mode', 'sandbox');

                $serverKey = $mode === 'production'
                    ? Setting::get('midtrans_production_server_key', config('midtrans.server_key'))
                    : Setting::get('midtrans_sandbox_server_key', config('midtrans.server_key'));

                $clientKey = $mode === 'production'
                    ? Setting::get('midtrans_production_client_key', config('midtrans.client_key'))
                    : Setting::get('midtrans_sandbox_client_key', config('midtrans.client_key'));

                config([
                    'midtrans.server_key' => $serverKey,
                    'midtrans.client_key' => $clientKey,
                    'midtrans.is_production' => $mode === 'production',
                    'midtrans.mode' => $mode,
                ]);
            }
        } catch (\Throwable $exception) {
            // Ignore configuration override failures during bootstrap
        }
    }
}
