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
        Schema::create('menus', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('menutitle'); // Menu Title
            $table->unsignedBigInteger('menucategory'); // Foreign key for menu category
            $table->unsignedTinyInteger('texttype'); // Menu Type
            $table->unsignedTinyInteger('txtpostion'); // Content Position
            $table->text('content')->nullable(); // Content for Menu Type 1
            $table->string('pdf_file')->nullable(); // PDF file for Menu Type 2
            $table->string('website_url')->nullable(); // Website URL for Menu Type 3
            $table->timestamps(); // Created at and Updated at
        });
    
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
};
