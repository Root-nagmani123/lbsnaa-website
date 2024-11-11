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
        Schema::create('courses_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->enum('language', ['1', '2'])->comment('1: English, 2: Hindi');
            $table->string('category_name');
            $table->string('color_theme')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable()->comment('Reference to parent category');
            $table->text('description')->nullable();
            $table->enum('status', ['1', '2', '3'])->comment('1: Draft, 2: Approval, 3: Publish');
            $table->timestamps();

            // Foreign key to self-reference parent category
            $table->foreign('parent_id')->references('id')->on('courses_sub_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses_sub_categories');
    }
};
