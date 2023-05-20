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
        Schema::table('audiovisual_sources', function(Blueprint $table) {
            $table->dropColumn(['title']);
        });

        Schema::create('audiovisual_sources_language', function (Blueprint $table) {
            $table->id();
            $table->integer("audiovisual_source_id");
            $table->string('title');
            $table->string('language');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audiovisual_sources_language');
    }
};
