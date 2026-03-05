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
        Schema::table('food', function (Blueprint $table) {
            $table->json('ingredients')->nullable();
            $table->integer('calories')->nullable();
            $table->json('dietary_restrictions')->nullable(); // e.g., ['vegan', 'gluten-free']
            $table->integer('preparation_time')->nullable(); // in minutes
            $table->boolean('is_vegetarian')->default(false);
            $table->boolean('is_vegan')->default(false);
            $table->boolean('is_gluten_free')->default(false);
            $table->decimal('rating', 3, 2)->default(0); // average rating
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('food', function (Blueprint $table) {
            $table->dropColumn(['ingredients', 'calories', 'dietary_restrictions', 'preparation_time', 'is_vegetarian', 'is_vegan', 'is_gluten_free', 'rating']);
        });
    }
};
