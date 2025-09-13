<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // No-op: tabel 'payments' tidak digunakan. Skema final menggunakan tabel 'payment'.
        if (Schema::hasTable('payments')) {
            return;
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
