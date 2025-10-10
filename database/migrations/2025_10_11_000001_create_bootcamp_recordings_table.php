<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bootcamp_recordings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('batch_id')->constrained('batch')->cascadeOnDelete();
            $table->string('title');
            $table->string('youtube_url');
            $table->text('description')->nullable();
            $table->dateTime('recorded_at')->nullable();
            $table->unsignedInteger('position')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->index(['batch_id', 'is_published']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bootcamp_recordings');
    }
};
