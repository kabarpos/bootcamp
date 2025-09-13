<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

Schema::create('certificate', function (Blueprint $table) {
    $table->id();
    $table->foreignId('enrollment_id')->constrained('enrollment')->cascadeOnDelete();
    $table->string('certificate_no', 100)->unique();
    $table->string('file_url');
    $table->timestamp('issued_at')->nullable();
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('certificate');
    }
};
