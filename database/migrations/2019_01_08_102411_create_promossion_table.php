<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromossionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
    {
            Schema::create('promossion', function (Blueprint $table) {
            $table->increments('id',11);
            $table->integer('studentID')->length(11)->unsigned();
            $table->string('old_year',250);
            $table->integer('old_semister_id')->length(11)->unsigned();
            $table->foreign('old_semister_id')->references('id')->on('semister')->onDelete('restrict')->onUpdate('cascade');

            $table->integer('shift_id')->length(11)->unsigned();
            $table->foreign('shift_id')->references('id')->on('shift')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('dept_id')->length(11)->unsigned();
            $table->foreign('dept_id')->references('id')->on('department')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('section_id')->length(11)->unsigned();
            $table->foreign('section_id')->references('id')->on('section')->onDelete('restrict')->onUpdate('cascade');

            $table->string('new_year',250);
            $table->integer('new_semister_id')->length(11)->unsigned();
            $table->foreign('new_semister_id')->references('id')->on('semister')->onDelete('restrict')->onUpdate('cascade');

            $table->string('roll',250);
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
       Schema::drop('promossion');
    }
}
