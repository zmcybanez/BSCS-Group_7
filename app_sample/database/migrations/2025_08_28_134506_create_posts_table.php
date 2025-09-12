<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id('PostID');
            $table->string('title');
            $table->text('content');
            $table->string('imgSrc')->nullable();
            $table->dateTime('date')->useCurrent();
            $table->unsignedBigInteger('userID');
            $table->unsignedBigInteger('categoryID')->nullable();
            $table->integer('likes_count')->default(0);
            $table->integer('comments_count')->default(0);
            $table->boolean('is_solved')->default(false);
            $table->string('status')->default('active');
            $table->timestamps();
            $table->softDeletes(); // Adds deleted_at column

            $table->foreign('userID')->references('UserID')->on('users')->onDelete('cascade');
            $table->foreign('categoryID')->references('CategoryID')->on('categories')->onDelete('set null');

            // Add indexes for better performance
            $table->index('date');
            $table->index('status');
            $table->index(['categoryID', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
