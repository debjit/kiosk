<?php

declare(strict_types=1);

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
        Schema::create('products', function (Blueprint $table): void {
            $table->id();
            $table->string('name', 255);
            $table->text('description')->nullable();
            $table->unsignedInteger('price'); // Stored in cents
            $table->foreignId('type_id')->constrained('product_types');
            $table->boolean('featured')->default(false);
            $table->unsignedTinyInteger('recommendation_score')->default(5); // 1-10 scale
            $table->string('category', 100)->nullable();
            $table->string('sku', 100)->unique()->nullable();
            $table->unsignedInteger('stock_quantity')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('type_id');
            $table->index('featured');
            $table->index('recommendation_score');
            $table->index('category');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
