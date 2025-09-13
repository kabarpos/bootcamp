<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // No-op: tabel 'roles' tidak digunakan. Skema final menggunakan tabel 'role'.
        if (Schema::hasTable('roles')) {
            return;
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
