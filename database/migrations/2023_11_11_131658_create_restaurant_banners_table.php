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
        Schema::create('restaurant_banners', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id');
            $table->string('offer')->nullable();
            $table->string('title')->nullable();
            $table->string('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->string('background')->nullable();
            $table->string('banner')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant_banners');
    }
};
