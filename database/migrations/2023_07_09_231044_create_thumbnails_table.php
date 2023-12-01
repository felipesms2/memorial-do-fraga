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
        Schema::create('thumbnails', function (Blueprint $table)
        {
            $table->id();
            $table->string("title_thumb"); /* if default, medium etc */
            $table->unsignedBigInteger("video_id");
            $table->string("url");
            $table->unsignedInteger("width");
            $table->unsignedInteger("height");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thumbnails');
    }
};
