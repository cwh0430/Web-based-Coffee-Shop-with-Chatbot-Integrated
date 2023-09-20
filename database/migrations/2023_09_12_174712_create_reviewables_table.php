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
        Schema::create('reviewables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rate_review_id')->references('id')->on('rate_reviews')->onDelete('cascade');
            $table->morphs('reviewable');
            $table->integer('rating');
            $table->longText('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviewables');
    }
};