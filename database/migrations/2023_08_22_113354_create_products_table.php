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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code')->unique();
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->foreignId('brand_id')->references('id')->on('brands');
            $table->string('first_image');
            $table->string('second_image')->nullable();
            $table->string('third_image')->nullable();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->enum('gender', ['male', 'female', 'all']);
            $table->text('description')->nullable();
            $table->unsignedInteger('weight');
            $table->unsignedInteger('actual_price');
            $table->unsignedInteger('final_price');
            $table->unsignedInteger('dealer_price');
            $table->unsignedInteger('discount')->nullable();
            $table->unsignedInteger('discount_min_quantity');
            $table->unsignedInteger('stock');
            $table->enum('status', ['published', 'scheduled', 'deleted']);
            $table->timestamps();
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
