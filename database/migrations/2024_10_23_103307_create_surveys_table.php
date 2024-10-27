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
        Schema::create('manage_surveys', function (Blueprint $table) {
            $table->id(); // Primary key (auto-incrementing)
            $table->string('survey_title');
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('status')->default(1); // 1 for Active, 0 for Inactive
            $table->timestamps(); // created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('surveys');
    }
};
