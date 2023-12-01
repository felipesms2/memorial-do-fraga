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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("channelId");
            $table->string("kind");
            $table->string("etag");
            $table->string("video_id");
            $table->timestamp("publishedAt");
            $table->longText("description");
            $table->string("categoryId");
            $table->string("liveBroadcastContent");
            $table->string("defaultAudioLanguage");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
