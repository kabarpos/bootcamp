<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

Schema::create('notification_log', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
    $table->enum('channel', ['email','whatsapp']);
    $table->string('template_key', 100);
    $table->json('payload_json')->nullable();
    $table->enum('status', ['queued','sent','failed'])->default('queued');
    $table->timestamp('sent_at')->nullable();
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('notification_log');
    }
};
