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
        Schema::create('mice_contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('destination_id')->constrained()->cascadeOnDelete();
            $table->string('region')->nullable();
            $table->json('title');
            $table->json('subtitle')->nullable();
            $table->json('description');
            $table->json('highlights')->nullable();
            $table->integer('min_delegates')->default(0);
            $table->integer('max_delegates')->nullable();
            $table->json('venue_features')->nullable();
            $table->json('services_included')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();

            $table->index(['destination_id', 'is_active']);
            $table->index(['min_delegates', 'max_delegates']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mice_contents');
    }
};
