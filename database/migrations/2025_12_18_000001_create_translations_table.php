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
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->string('translatable_type');
            $table->unsignedBigInteger('translatable_id');
            $table->string('source_locale', 5)->default('en');
            $table->string('target_locale', 5);
            $table->string('field');
            $table->enum('status', ['pending', 'in_progress', 'completed', 'failed'])->default('pending');
            $table->text('error_message')->nullable();
            $table->unsignedInteger('retry_count')->default(0);
            $table->timestamp('translated_at')->nullable();
            $table->timestamps();

            // Indexes for efficient querying
            $table->index(['translatable_type', 'translatable_id', 'target_locale'], 'translations_model_locale_index');
            $table->index(['status', 'created_at'], 'translations_status_created_index');
            $table->unique(
                ['translatable_type', 'translatable_id', 'target_locale', 'field'],
                'translations_unique_field'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translations');
    }
};
