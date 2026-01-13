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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Pastikan baris ini ada
            $table->string('difficulty'); // Mudah, Menengah, Sulit
            $table->string('image');
            $table->integer('cooking_time')->default(30);
            $table->json('ingredients');
            $table->json('steps');
            $table->boolean('is_featured')->default(false);

            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};