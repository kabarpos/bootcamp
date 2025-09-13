<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // No-op: tabel 'blog_posts' tidak digunakan. Skema final menggunakan tabel 'blog_post'.
        if (Schema::hasTable('blog_posts')) {
            return;
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('blog_posts');
    }
};
