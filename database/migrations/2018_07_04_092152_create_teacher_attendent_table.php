<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeacherAttendentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('teacher_attendent', function (Blueprint $table) {
            $table->increments('id',11);
            $table->integer('teacherId')->length(11)->unsigned();
            $table->foreign('teacherId')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->tinyInteger('type');
            $table->integer('session_id')->length(11)->unsigned();
              $table->foreign('session_id')->references('id')->on('session')->onDelete('restrict')->onUpdate('cascade');
            $table->string('year',250);
            $table->integer('shift_id')->length(11)->unsigned();
            $table->foreign('shift_id')->references('id')->on('shift')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('dept_id')->length(11)->unsigned();
            $table->foreign('dept_id')->references('id')->on('department')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('semister_id')->length(11)->unsigned();
            $table->foreign('semister_id')->references('id')->on('semister')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('day')->length(11)->unsigned();
            $table->integer('class_no')->length(11)->unsigned();
            $table->foreign('class_no')->references('id')->on('routine')->onDelete('restrict')->onUpdate('cascade');
            $table->tinyInteger('status')->length(11)->unsigned()->comment = "1=Enter into class 2=out from class";
            $table->date('enter_time');
            $table->date('out_time');
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
