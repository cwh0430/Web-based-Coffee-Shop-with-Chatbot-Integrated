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
            $table->string('img');
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