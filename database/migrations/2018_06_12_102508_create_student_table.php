<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('student', function (Blueprint $table) {
            $table->increments('id',11);
            $table->integer('studentID')->length(11)->unsigned();
            $table->string('rfIdCard',250);
            $table->string('session',250);
            $table->string('year',250);
            $table->integer('shift_id')->length(11)->unsigned();
            $table->foreign('shift_id')->references('id')->on('shift')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('dept_id')->length(11)->unsigned();
            $table->foreign('dept_id')->references('id')->on('department')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('semister_id')->length(11)->unsigned();
            $table->foreign('semister_id')->references('id')->on('semister')->onDelete('restrict')->onUpdate('cascade');
            $table->string('roll',250);
            $table->string('registration',250);
            $table->date('created_at');
            $table->date('modified_at');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
