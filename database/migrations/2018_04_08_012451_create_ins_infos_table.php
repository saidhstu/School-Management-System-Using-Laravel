<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ins_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_bangla')->nullable();
            $table->string('name_english')->nullable();
            $table->string('eiin_num')->nullable();
            $table->string('reg_year')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('ins_infos');
    }
}
