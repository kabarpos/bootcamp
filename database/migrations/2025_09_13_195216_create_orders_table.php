<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Lewati pembuatan tabel di migrasi placeholder ini untuk menghindari duplikasi.
        // Tabel 'orders' didefinisikan lengkap pada migrasi 2025_09_14_000012_create_orders_table.php
        if (Schema::hasTable('orders')) {
            return;
        }
        // Tidak melakukan apa-apa di sini secara sengaja.
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Biarkan aman pada rollback penuh; dropIfExists tetap idempotent.
        Schema::dropIfExists('orders');
    }
};
