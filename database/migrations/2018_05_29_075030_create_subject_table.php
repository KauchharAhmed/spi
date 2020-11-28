<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // create subject table
           Schema::create('subject', function (Blueprint $table) {
            $table->increments('id',11);
            $table->integer('added_id')->length(10)->unsigned();;
            $table->foreign('added_id')->references('id')->on('department_head')->onDelete('restrict')->onUpdate('cascade');
             $table->integer('dept_id')->length(10)->unsigned();
            $table->foreign('dept_id')->references('id')->on('department')->onDelete('restrict')->onUpdate('cascade');
            $table->integer('semister_id')->length(10)->unsigned();
             $table->foreign('semister_id')->references('id')->on('semister')->onDelete('restrict')->onUpdate('cascade');
            $table->string('subject_name',250);
            $table->string('subject_code',250);
            $table->integer('cradit')->length(10)->unsigned();
            $table->tinyInteger('subject_type');
            $table->float('theroy_marks',40,2);
            $table->float('practical_marks',40,2);
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
