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
    Schema::create('employee_forms', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('parent_id')->nullable(); // Parent ID for hierarchy
        $table->enum('language', ['1', '2']);
        $table->unsignedBigInteger('faculty_id')->nullable()->comment('References id in employees table');
        $table->string('employee_name');
        $table->text('description')->nullable();
        $table->enum('status', ['1', '2', '3']);
        $table->tinyInteger('category')->nullable(); // Category column
        $table->timestamps();

        // Foreign key constraint for parent_employee_id
        $table->foreign('parent_employee_id')->references('id')->on('employees')->onDelete('set null');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_forms');
    }
};
