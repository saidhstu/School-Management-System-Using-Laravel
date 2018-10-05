<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFailSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fail_subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->integer('student_roll');
            $table->integer('sclass_id');
            $table->integer('session');
            $table->integer('exam_id');
            $table->integer('section_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('subject_id');
            $table->string('part');
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
        Schema::dropIfExists('fail_subjects');
    }
}
