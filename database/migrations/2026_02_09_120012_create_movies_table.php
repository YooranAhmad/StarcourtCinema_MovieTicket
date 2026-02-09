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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('rating'); // PG, PG-13, R, etc.
            $table->string('duration'); // e.g., "115 MIN"
            $table->integer('price'); // in rupiah
            $table->string('image')->nullable(); // poster image path
            $table->integer('stars')->default(5); // rating out of 5
            $table->text('description');
            $table->json('showtimes'); // array of times
            $table->string('trailer')->nullable(); // YouTube video ID
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
