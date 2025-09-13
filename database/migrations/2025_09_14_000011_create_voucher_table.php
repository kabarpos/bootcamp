<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

Schema::create('voucher', function (Blueprint $table) {
    $table->id();
    $table->string('code', 50)->unique();
    $table->enum('type', ['percent','amount']);
    $table->decimal('value', 12, 2)->default(0);
    $table->decimal('max_discount', 12, 2)->nullable();
    $table->date('valid_from')->nullable();
    $table->date('valid_to')->nullable();
    $table->integer('usage_limit')->nullable();
    $table->integer('used_count')->default(0);
    $table->boolean('is_active')->default(true);
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('voucher');
    }
};
