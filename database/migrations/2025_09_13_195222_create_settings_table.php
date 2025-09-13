<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // No-op: tabel 'settings' tidak digunakan. Skema final menggunakan tabel 'setting'.
        if (Schema::hasTable('settings')) {
            return;
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
