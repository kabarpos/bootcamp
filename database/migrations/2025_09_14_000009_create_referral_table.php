<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

Schema::create('referral', function (Blueprint $table) {
    $table->id();
    $table->string('code', 50)->unique();
    $table->foreignId('owner_user_id')->constrained('users')->cascadeOnDelete();
    $table->boolean('is_active')->default(true);
    $table->integer('usage_limit')->nullable();
    $table->integer('used_count')->default(0);
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('referral');
    }
};
