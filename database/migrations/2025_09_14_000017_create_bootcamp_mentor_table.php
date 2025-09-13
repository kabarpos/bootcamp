<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

Schema::create('bootcamp_mentor', function (Blueprint $table) {
    $table->id();
    $table->foreignId('bootcamp_id')->constrained('bootcamp')->cascadeOnDelete();
    $table->foreignId('mentor_id')->constrained('mentor')->cascadeOnDelete();
    $table->timestamps();
    $table->unique(['bootcamp_id','mentor_id']);
});

    }

    public function down(): void
    {
        Schema::dropIfExists('bootcamp_mentor');
    }
};
