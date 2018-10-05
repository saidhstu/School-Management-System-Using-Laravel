<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSentMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sent_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id');
            $table->integer('teacher_id')->nullable();
            $table->integer('student_roll');
            $table->integer('sclass_id');
            $table->integer('session');
            $table->integer('section_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('is_read')->nullable();
            $table->string('subject')->nullable();
            $table->string('message')->nullable();
            $table->string('file')->nullable();
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
        Schema::dropIfExists('sent_messages');
    }
}
