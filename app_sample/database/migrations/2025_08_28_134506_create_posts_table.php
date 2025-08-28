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
            $table->timestamps();

            $table->foreign('userID')->references('UserID')->on('users')->onDelete('cascade');
            $table->foreign('categoryID')->references('CategoryID')->on('categories')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
