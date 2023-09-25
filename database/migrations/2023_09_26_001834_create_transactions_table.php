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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->foreignId('cashier_id')->nullable()->references('id')->on('users');
            $table->foreignId('customer_id')->nullable()->references('id')->on('users');
            $table->string('discount_min_purchases')->nullable(); // (min_purchase_amount:1),(percentage:25),(created_at:12/01/2023)
            $table->string('discount_coupons')->nullable(); // (min_purchase_amount),(name),(percentage),(created_at)
            $table->unsignedInteger('total');
            $table->enum('method', ['cash', 'transfer']);
            $table->string('pdf_url')->nullable();
            $table->text('note')->nullable();
            $table->enum('status', ['active', 'deleted'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
