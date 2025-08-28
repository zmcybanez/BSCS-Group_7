<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id('ResourceID');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('fileUrl');
            $table->unsignedBigInteger('uploaded_by');
            $table->timestamps();

            // Foreign key: uploaded_by → users(UserID)
            $table->foreign('uploaded_by')->references('UserID')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
