<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id('CommentID'); 
            $table->text('text');
            $table->dateTime('dateCreated')->useCurrent();
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('postID');
            $table->timestamps();

            // Foreign keys
            $table->foreign('userID')->references('UserID')->on('users')->onDelete('cascade');
            $table->foreign('postID')->references('PostID')->on('posts')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
