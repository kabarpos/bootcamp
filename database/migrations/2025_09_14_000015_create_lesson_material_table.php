<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

Schema::create('lesson_material', function (Blueprint $table) {
    $table->id();
    $table->foreignId('bootcamp_id')->constrained('bootcamp')->cascadeOnDelete();
    $table->foreignId('batch_id')->nullable()->constrained('batch')->nullOnDelete();
    $table->string('title');
    $table->enum('type', ['file','link','video']);
    $table->string('file_url')->nullable();
    $table->string('external_link')->nullable();
    $table->timestamp('published_at')->nullable();
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('lesson_material');
    }
};
