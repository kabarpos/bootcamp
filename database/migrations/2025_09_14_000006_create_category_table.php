<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

Schema::create('category', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('slug')->unique();
    $table->enum('type', ['bootcamp','blog'])->default('bootcamp');
    $table->timestamps();
    $table->unique(['name','type']);
});

    }

    public function down(): void
    {
        Schema::dropIfExists('category');
    }
};
