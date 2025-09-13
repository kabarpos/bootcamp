<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // No-op: tabel 'notification_logs' tidak digunakan. Skema final menggunakan tabel 'notification_log'.
        if (Schema::hasTable('notification_logs')) {
            return;
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_logs');
    }
};
