<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
    {
            // create the students table
            Schema::create('reg', function (Blueprint $table) {
            $table->increments('id',11);
            $table->string('studentName',250);
            $table->string('fatherName',250);
            $table->string('motherName',250);
            $table->string('studentEmail',250);
            $table->string('studentMobile',20);
            $table->string('parentsMobile',20);
            $table->date('studentBirthDate');
            $table->string('studentSex',20);
            $table->mediumText('presentAdd');
            $table->mediumText('permanentAdd');
            $table->string('studentReligion',100);
            $table->string('studentImage',250);
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
          Schema::drop('reg');
    }
}
