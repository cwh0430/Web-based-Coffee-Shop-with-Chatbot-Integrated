<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('beverage_beverage_cart', function (Blueprint $table) {
            $table->id();
            $table->foreignId('beverage_cart_id')->references('id')->on('beverage_carts')->onDelete('cascade');
            $table->foreignId('beverage_id')->references('id')->on('beverages')->onDelete('cascade');
            $table->integer('quantity');
            $table->integer('sub_price');
            $table->json('customization');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beverage_cart_beverage_products');
    }
};