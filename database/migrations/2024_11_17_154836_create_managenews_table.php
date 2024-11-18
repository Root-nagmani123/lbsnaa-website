<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creating the managenews table
        Schema::create('managenews', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('short_description');
            $table->string('meta_title');
            $table->string('meta_keywords')->nullable();
            $table->text('meta_description')->nullable();
            $table->longText('description');
            $table->string('main_image');
            $table->json('multiple_images')->nullable(); // For storing multiple images
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('status')->default(1); // 1 = active, 0 = inactive
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Dropping the managenews table
        Schema::dropIfExists('managenews');
    }
};
