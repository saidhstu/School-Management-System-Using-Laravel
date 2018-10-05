<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeritsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->integer('student_roll');
            $table->integer('sclass_id');
            $table->integer('session');
            $table->integer('exam_id');
            $table->integer('section_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('total_mark');
            $table->float('gpa');
            $table->string('grade');
            $table->integer('pass')->nullable();
            $table->integer('fail')->nullable();
            $table->integer('is_golden')->nullable();
            $table->float('wo_gpa')->nullable();
            $table->integer('position')->nullable();
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
        Schema::dropIfExists('merits');
    }
}
