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
            $table->unsignedBigInteger('parent_id')->nullable(); // For nested comments
            $table->integer('likes_count')->default(0);
            $table->string('status')->default('active');
            $table->timestamps();
            $table->softDeletes(); // Adds deleted_at column

            // Foreign keys
            $table->foreign('userID')->references('UserID')->on('users')->onDelete('cascade');
            $table->foreign('postID')->references('PostID')->on('posts')->onDelete('cascade');
            $table->foreign('parent_id')->references('CommentID')->on('comments')->onDelete('cascade');

            // Add indexes for better performance
            $table->index('dateCreated');
            $table->index('status');
            $table->index(['postID', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
