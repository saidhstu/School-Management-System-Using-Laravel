<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sclass_id');
            $table->integer('exam_id');
            $table->integer('group_id')->nullable();
            $table->integer('subject_id');
            $table->integer('subjective')->nullable();
            $table->integer('sub_pass')->nullable();
            $table->integer('objective')->nullable();
            $table->integer('obj_pass')->nullable();
            $table->integer('practical')->nullable();
            $table->integer('prac_pass')->nullable();
            $table->integer('percent')->nullable();
            $table->string('part')->nullable();
            $table->integer('total_pass')->nullable();
            $table->integer('inactive')->nullable();
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
        Schema::dropIfExists('class_subjects');
    }
}
