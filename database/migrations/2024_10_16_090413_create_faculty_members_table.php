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
        Schema::create('faculty_members', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('name');
            $table->string('name_in_hindi')->nullable();
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->text('description_in_hindi')->nullable();
            $table->string('designation');
            $table->string('designation_in_hindi')->nullable();
            $table->string('cadre')->nullable();
            $table->string('batch')->nullable();
            $table->string('service')->nullable();
            $table->string('country_code')->nullable();
            $table->string('std_code')->nullable();
            $table->string('phone_internal_office')->nullable();
            $table->string('phone_internal_residence')->nullable();
            $table->string('phone_pt_office')->nullable();
            $table->string('phone_pt_residence')->nullable();
            $table->string('mobile')->nullable();
            $table->string('abbreviation')->nullable();
            $table->string('rank')->nullable();
            $table->boolean('present_at_station')->default(0);
            $table->boolean('acm_member')->default(0);
            $table->string('acm_status_in_committee')->nullable();
            $table->boolean('co_opted_member')->default(0);
            $table->boolean('page_status')->default(1);
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
        Schema::dropIfExists('faculty_members');
    }
};
