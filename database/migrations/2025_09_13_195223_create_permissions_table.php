<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // No-op: tabel 'permissions' tidak digunakan. Skema final menggunakan tabel 'permission'.
        if (Schema::hasTable('permissions')) {
            return;
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
