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
        Schema::create('map_playlist', function (Blueprint $table) {
            $table->unsignedBigInteger('map_id');
            $table->foreign('map_id')->references('id')->on('maps')->onDelete('cascade');
            $table->unsignedBigInteger('playlist_id');
            $table->foreign('playlist_id')->references('id')->on('playlists')->onDelete('cascade');
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('map_playlist');
    }
};
