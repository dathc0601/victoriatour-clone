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
        Schema::create('about_page', function (Blueprint $table) {
            $table->id();

            // Hero Section (translatable)
            $table->json('hero_category')->nullable();
            $table->json('hero_line1')->nullable();
            $table->json('hero_line2')->nullable();
            $table->json('hero_line3')->nullable();
            $table->json('hero_subtitle')->nullable();

            // Story Section (translatable)
            $table->json('story_title')->nullable();
            $table->json('story_content')->nullable();

            // Mission Section (translatable)
            $table->json('mission_title')->nullable();
            $table->json('mission_content')->nullable();

            // Vision Section (translatable)
            $table->json('vision_title')->nullable();
            $table->json('vision_content')->nullable();

            // Stats (number + translatable labels)
            $table->string('stat1_number')->default('15+');
            $table->json('stat1_label')->nullable();
            $table->string('stat2_number')->default('5000+');
            $table->json('stat2_label')->nullable();
            $table->string('stat3_number')->default('50+');
            $table->json('stat3_label')->nullable();
            $table->string('stat4_number')->default('100%');
            $table->json('stat4_label')->nullable();

            // SEO (translatable)
            $table->json('meta_title')->nullable();
            $table->json('meta_description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_page');
    }
};
