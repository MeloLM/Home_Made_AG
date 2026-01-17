<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Migration for the event_product pivot table.
 *
 * This establishes a Many-to-Many relationship between events and products.
 * A single product (e.g., a rosary) can be suitable for multiple events
 * (e.g., Baptism, First Communion, Confirmation).
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event_product', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('event_id')
                ->constrained('events')
                ->cascadeOnDelete();
            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();
            $table->boolean('is_featured_in_event')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            // Ensure unique combination of event and product
            $table->unique(['event_id', 'product_id']);

            // Indexes for performance
            $table->index('is_featured_in_event');
            $table->index('sort_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_product');
    }
};
