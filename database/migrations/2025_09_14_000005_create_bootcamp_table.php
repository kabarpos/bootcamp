<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

Schema::create('bootcamp', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('slug')->unique();
    $table->enum('mode', ['online','offline','hybrid'])->default('online');
    $table->enum('level', ['beginner','intermediate','advanced'])->default('beginner');
    $table->decimal('base_price', 12, 2)->default(0);
    $table->integer('duration_hours')->default(0);
    $table->text('short_desc')->nullable();
    $table->text('syllabus_summary')->nullable();
    $table->boolean('is_active')->default(true);
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('bootcamp');
    }
};
