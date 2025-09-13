<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Jangan buat ulang tabel users jika sudah dibuat oleh migrasi bawaan Jetstream
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->foreignId('current_team_id')->nullable();
                $table->string('profile_photo_path', 2048)->nullable();
                $table->timestamps();
            });
        }

        // Tambahkan kolom phone_whatsapp jika belum ada
        if (!Schema::hasColumn('users', 'phone_whatsapp')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('phone_whatsapp', 32)->nullable()->unique()->after('email');
            });
        }
    }

    public function down(): void
    {
        // Hanya rollback perubahan yang dibuat oleh migrasi ini
        if (Schema::hasColumn('users', 'phone_whatsapp')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('phone_whatsapp');
            });
        }
    }
};
