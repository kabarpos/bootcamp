<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

Schema::create('mentor', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
    $table->string('name');
    $table->string('headline')->nullable();
    $table->text('bio')->nullable();
    $table->string('photo_url')->nullable();
    $table->string('linkedin_url')->nullable();
    $table->string('website_url')->nullable();
    $table->timestamps();
    $table->unique(['user_id']);
});

    }

    public function down(): void
    {
        Schema::dropIfExists('mentor');
    }
};
