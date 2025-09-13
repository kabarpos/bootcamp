<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('enrollments')) {
            return;
        }
        // No-op: tabel enrollments didefinisikan oleh migrasi lain
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
