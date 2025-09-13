<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

Schema::create('setting', function (Blueprint $table) {
    $table->id();
    $table->string('key', 128);
    $table->text('value')->nullable();
    $table->string('group_key', 64)->nullable();
    $table->timestamps();
    $table->unique(['key','group_key']);
});

    }

    public function down(): void
    {
        Schema::dropIfExists('setting');
    }
};
