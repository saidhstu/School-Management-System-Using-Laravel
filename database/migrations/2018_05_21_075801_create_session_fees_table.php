<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_fees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->integer('sclass_id');
            $table->integer('section_id')->nullable();
            $table->integer('staying_id')->nullable();
            $table->integer('version_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('session')->nullable();
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
        Schema::dropIfExists('session_fees');
    }
}
