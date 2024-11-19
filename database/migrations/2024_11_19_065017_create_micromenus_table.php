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
        Schema::create('micromenus', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('language')->unsigned();
            $table->bigInteger('research_centreid')->unsigned(); // New column added
            $table->integer('parent_id')->nullable();
            $table->string('menutitle');
            $table->text('menu_slug')->nullable();
            $table->bigInteger('menucategory')->unsigned();
            $table->tinyInteger('texttype')->unsigned();
            $table->tinyInteger('txtpostion')->unsigned();
            $table->text('content')->nullable();
            $table->string('pdf_file')->nullable();
            $table->string('website_url')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->longText('meta_description')->nullable();
            $table->integer('web_site_target')->nullable();
            $table->string('start_date', 100)->nullable();
            $table->string('termination_date', 100)->nullable();
            $table->tinyInteger('menu_status')->default(0);
            $table->timestamps();
            $table->tinyInteger('is_deleted')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('micromenus');
    }
};
