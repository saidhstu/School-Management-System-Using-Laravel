<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->integer('student_roll');
            $table->integer('sclass_id');
            $table->integer('section_id')->nullable();
            $table->integer('staying_id')->nullable();
            $table->integer('version_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('session')->nullable();
            $table->integer('month')->nullable();
            $table->integer('status')->nullable();
            $table->string('attendence_date')->nullable();
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
        Schema::dropIfExists('attendences');
    }
}
