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
        Schema::create('book_areas', function (Blueprint $table) {
            $table->id();
            $table->string('short_title')->nullable();
            $table->string('main_title')->nullable();
            $table->string('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->string('author')->nullable();
            $table->string('link_url')->nullable();
            $table->string('small_image')->nullable();
            $table->string('big_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_areas');
    }
};
