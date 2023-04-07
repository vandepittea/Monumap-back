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
        Schema::create('monuments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->json('location');
            $table->string('historical_significance')->nullable();
            $table->enum('type', [
                'War Memorials',
                'Statues and Sculptures',
                'Historical Buildings and Sites',
                'National Monuments',
                'Archaeological Sites',
                'Cultural and Religious Monuments',
                'Public Art Installations',
                'Memorials for Historical Events',
                'Natural Monuments,Tombs and Mausoleums'
            ]);
            $table->integer('year_of_construction');
            $table->string('monument_designer');
            $table->enum('accessibility', [
                'wheelchair-friendly',
                'near parking areas',
                'low-slope ramps',
                'power-assisted doors',
                'elevators, accessible washrooms'
            ]);
            $table->json('used_materials')->nullable();
            $table->json('dimensions')->nullable();
            $table->integer('weight')->nullable();
            $table->decimal('cost_to_construct', 10, 2)->nullable();
            $table->json('images');
            $table->json('audiovisual_sources')->nullable();
            $table->enum('language', [
                'Dutch',
                'English'
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monuments');
    }
};