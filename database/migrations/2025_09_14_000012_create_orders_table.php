<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {

Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->foreignId('enrollment_id')->constrained('enrollment')->cascadeOnDelete();
    $table->string('invoice_no', 64)->unique();
    $table->decimal('amount', 12, 2)->default(0);
    $table->decimal('discount_amount', 12, 2)->default(0);
    $table->decimal('total', 12, 2)->default(0);
    $table->foreignId('voucher_id')->nullable()->constrained('voucher')->nullOnDelete();
    $table->enum('status', ['pending','paid','expired','failed','refunded'])->default('pending');
    $table->timestamp('expired_at')->nullable();
    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
