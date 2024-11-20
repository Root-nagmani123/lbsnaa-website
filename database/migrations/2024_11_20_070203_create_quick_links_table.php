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
        Schema::create('micro_quick_links', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->unsignedBigInteger('research_centre_id');
            $table->unsignedTinyInteger('language');
            $table->unsignedTinyInteger('categorytype');
            $table->string('txtename', 255);
            $table->string('menu_type', 255);
            $table->string('meta_title', 255)->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('description')->nullable();
            $table->string('pdf_file', 255)->nullable();
            $table->date('start_date')->nullable();
            $table->date('termination_date')->nullable();
            $table->string('website_url', 255)->nullable();
            $table->unsignedTinyInteger('status');
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
        Schema::dropIfExists('micro_quick_links');
    }
};
