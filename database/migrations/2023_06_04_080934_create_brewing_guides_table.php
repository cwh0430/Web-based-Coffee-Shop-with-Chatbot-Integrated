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
        Schema::create('brewing_guides', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('desc');
            $table->json('using_tools');
            $table->json('instructions');
            $table->json('tips')->nullable();
            $table->foreignId('homebrew_product_id')->references('id')->on('homebrew_products')->onDelete('cascade')->nullable();
            $table->foreignId('mechanic_id')->references('id')->on('mechanics')->onDelete('cascade');
            $table->string('cover_img');
            $table->string('working_img');
            $table->string('final_product_img');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brewing_guides');
    }
};