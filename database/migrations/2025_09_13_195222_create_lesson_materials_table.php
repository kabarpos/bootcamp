<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // No-op: tabel 'lesson_materials' tidak digunakan. Skema final menggunakan tabel 'lesson_material'.
        if (Schema::hasTable('lesson_materials')) {
            return;
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('lesson_materials');
    }
};
