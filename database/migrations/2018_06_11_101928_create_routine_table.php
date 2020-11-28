<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoutineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // crate the routine table
            Schema::create('routine', function (Blueprint $table) {
            $table->increments('id',11);
            $table->integer('added_id')->length(11)->unsigned();
            $table->foreign('added_id')->references('id')->on('department_head')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('dept_id')->length(11)->unsigned();
            $table->foreign('dept_id')->references('id')->on('department')->onDelete('restrict')->onUpdate('cascade');
            $table->string('year',250);
            $table->integer('shift_id')->length(11)->unsigned();
            $table->foreign('shift_id')->references('id')->on('shift')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('semister_id')->length(11)->unsigned();
            $table->foreign('semister_id')->references('id')->on('semister')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('subject_id')->length(11)->unsigned();
            $table->foreign('subject_id')->references('id')->on('subject')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('teacher_id')->length(11)->unsigned();
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('craft')->length(11)->unsigned();
            $table->string('room_no',250);
            $table->integer('day')->length(11)->unsigned();
            $table->time('from');
            $table->time('to');
            $table->integer('class_no')->length(11)->unsigned();
            $table->mediumText('remarks');
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
