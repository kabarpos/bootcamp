<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('enrollment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('batch_id')->constrained('batch')->cascadeOnDelete();
            $table->foreignId('referral_id')->nullable()->constrained('users')->nullOnDelete();
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending');
            $table->timestamps();
            $table->unique(['user_id', 'batch_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollment');
    }
};
