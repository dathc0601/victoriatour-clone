<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seo_page_overrides', function (Blueprint $table) {
            $table->id();
            $table->string('url_path')->index();
            $table->boolean('is_wildcard')->default(false);
            $table->integer('priority')->default(0);
            $table->json('title')->nullable();
            $table->json('meta_title')->nullable();
            $table->json('meta_description')->nullable();
            $table->json('og_title')->nullable();
            $table->json('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('meta_robots')->nullable();
            $table->string('canonical_url')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['url_path']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_page_overrides');
    }
};
