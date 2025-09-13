<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // No-op: tabel 'vouchers' tidak digunakan. Skema final menggunakan tabel 'voucher'.
        if (Schema::hasTable('vouchers')) {
            return;
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
