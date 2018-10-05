<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('elecs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->integer('sclass_id');
            $table->integer('section_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('session')->nullable();
            $table->integer('month')->nullable();
            $table->integer('amount')->nullable();
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
        Schema::dropIfExists('elecs');
    }
}
