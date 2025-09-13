<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

Schema::create('batch', function (Blueprint $table) {
    $table->id();
    $table->foreignId('bootcamp_id')->constrained('bootcamp')->cascadeOnDelete();
    $table->string('code', 64)->unique();
    $table->date('start_date');
    $table->date('end_date');
    $table->time('start_time')->nullable();
    $table->time('end_time')->nullable();
    $table->foreignId('city_id')->nullable()->constrained('city')->nullOnDelete();
    $table->string('venue_name')->nullable();
    $table->string('venue_address')->nullable();
    $table->string('meeting_link')->nullable();
    $table->string('meeting_platform', 50)->nullable();
    $table->enum('status', ['upcoming','ongoing','finished','canceled'])->default('upcoming');
    $table->integer('capacity')->default(0);
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('batch');
    }
};
