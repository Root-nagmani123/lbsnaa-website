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
        Schema::create('research_centres', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->tinyInteger('language')->unsigned()->comment('1: English, 2: Hindi');
            $table->string('research_centre_name', 255);
            $table->text('description')->nullable();
            $table->tinyInteger('status')->unsigned()->comment('1: Active, 0: Inactive');
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('research_centres');
    }
};
