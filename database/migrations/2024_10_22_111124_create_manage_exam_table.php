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
        Schema::create('manage_exam', function (Blueprint $table) {
            $table->id();
            $table->string('exam_code', 50);
            $table->text('exam_description')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->date('transaction_date')->nullable();
            $table->tinyInteger('preliminary_flag')->comment('1 for Yes, 0 for No');
            $table->tinyInteger('main_flag')->comment('1 for Yes, 0 for No');
            $table->tinyInteger('status')->default(1)->comment('1 for Active, 0 for Inactive');
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
        Schema::dropIfExists('manage_exam');
    }
};
