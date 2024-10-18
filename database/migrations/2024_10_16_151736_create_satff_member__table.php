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
        Schema::create('staff_members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_in_hindi')->nullable();
            $table->string('email')->unique();
            $table->string('image')->nullable(); // For image upload
            $table->text('description')->nullable();
            $table->text('description_in_hindi')->nullable();
            $table->string('designation');
            $table->string('designation_in_hindi')->nullable();
            $table->string('section')->nullable(); // Select box, can be foreign key if needed
            $table->string('country_code')->nullable();
            $table->string('std_code')->nullable();
            $table->string('phone_internal_office')->nullable();
            $table->string('phone_internal_residence')->nullable();
            $table->string('phone_pt_office')->nullable();
            $table->string('phone_pt_residence')->nullable();
            $table->string('mobile')->unique();
            $table->string('abbreviation')->nullable();
            $table->string('rank')->nullable();
            $table->boolean('present_at_station')->default(false);
            $table->boolean('acm_member')->default(false);
            $table->string('acm_status_in_committee')->nullable();
            $table->boolean('co_opted_member')->default(false);
            $table->boolean('page_status')->default(true); // Active/Inactive
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
        Schema::dropIfExists('satff_member');
    }
};
