<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();

            // Tree structure (required by filament-tree)
            $table->bigInteger('parent_id')->default(-1);
            $table->integer('order')->default(0);

            // Content (translatable)
            $table->json('title');

            // Link type management
            $table->enum('type', ['url', 'route', 'page'])->default('url');
            $table->string('url')->nullable();
            $table->string('route_name')->nullable();
            $table->foreignId('page_id')->nullable()->constrained('pages')->nullOnDelete();

            // Additional options
            $table->string('icon')->nullable();
            $table->enum('target', ['_self', '_blank'])->default('_self');
            $table->enum('location', ['header', 'footer'])->default('header');
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Indexes
            $table->index(['location', 'is_active']);
            $table->index('parent_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
