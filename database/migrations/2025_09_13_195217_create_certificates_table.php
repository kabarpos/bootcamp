<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // No-op: tabel 'certificates' tidak digunakan. Skema final menggunakan tabel 'certificate'.
        if (Schema::hasTable('certificates')) {
            return;
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
