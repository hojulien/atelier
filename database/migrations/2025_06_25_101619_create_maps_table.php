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
        Schema::create('maps', function (Blueprint $table) {
            $table->id();
            $table->string('rc', 20)->nullable();
            $table->string('artist', 40);
            $table->string('title', 80);
            $table->string('artistUnicode', 25)->nullable();
            $table->string('titleUnicode', 50)->nullable();
            $table->string('creator', 20);
            $table->decimal('sr', 8, 5);
            $table->integer('length');
            $table->decimal('cs', 4, 2);
            $table->decimal('hp', 4, 2);
            $table->decimal('ar', 4, 2);
            $table->decimal('od', 4, 2);
            $table->integer('setId');
            $table->integer('mapId')->unique();
            $table->dateTime('submitDate');
            $table->dateTime('lastUpdated');
            $table->json('tags')->nullable();
            $table->string('background', 255)->default('default.jpg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maps');
    }
};
