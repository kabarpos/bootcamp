<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

Schema::create('payment', function (Blueprint $table) {
    $table->id();
    $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
    $table->enum('method', ['va','qris','ewallet','cc','manual']);
    $table->enum('provider', ['midtrans','xendit','doku'])->nullable();
    $table->string('transaction_id', 100)->nullable()->unique();
    $table->string('va_number', 64)->nullable();
    $table->string('ewallet_ref', 100)->nullable();
    $table->enum('status', ['waiting','success','failed'])->default('waiting');
    $table->timestamp('paid_at')->nullable();
    $table->string('receipt_url')->nullable();
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
