<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->id('LikeID');
            $table->unsignedBigInteger('postID');
            $table->unsignedBigInteger('userID');
            $table->string('reactionType')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('postID')->references('PostID')->on('posts')->onDelete('cascade');
            $table->foreign('userID')->references('UserID')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
