<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->integer('student_roll');
            $table->integer('sclass_id');
            $table->integer('session');
            $table->integer('exam_id');
            $table->integer('section_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('subject_id');
            $table->integer('subjective')->nullable();
            $table->integer('is_sub_pass')->nullable();
            $table->integer('objective')->nullable();
            $table->integer('is_obj_pass')->nullable();
            $table->integer('practical')->nullable();
            $table->integer('is_prac_pass')->nullable();
            $table->integer('monthly')->nullable();
            $table->integer('total')->nullable();
            $table->integer('percent')->nullable();
            $table->integer('part_monthly')->nullable();
            $table->integer('part_sub')->nullable();
            $table->integer('part_obj')->nullable();
            $table->integer('part_prac')->nullable();
            $table->integer('part_mark')->nullable();
            $table->string('part')->nullable();
            $table->integer('total_mark')->nullable();
            $table->float('gpa')->nullable();
            $table->string('grade')->nullable();
            $table->integer('is_opt')->nullable();
            $table->float('opt_point')->nullable();
            $table->integer('inactive')->nullable();
            $table->integer('teacher_id')->nullable();
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
        Schema::dropIfExists('results');
    }
}
