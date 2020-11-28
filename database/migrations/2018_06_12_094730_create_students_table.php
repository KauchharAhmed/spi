<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            // create the students table
            Schema::create('students', function (Blueprint $table) {
            $table->increments('id',11);
            $table->integer('added_id')->length(11)->unsigned();
            $table->string('studentLogin',250);
            $table->string('studentName',250);
            $table->string('stuBangalName',250);
            $table->string('schoolName',250);
            $table->string('fatherName',250);
            $table->string('motherName',250);
            $table->string('studentEmail',250);
            $table->string('studentMobile',20);
            $table->string('parentsMobile',20);
            $table->date('studentBirthDate');
            $table->string('studentSex',20);
            $table->mediumText('presentAdd');
            $table->mediumText('permanentAdd');
            $table->string('studentPwd',250);
            $table->string('studentReligion',100);
            $table->string('studentImage',250);
            $table->string('recoverCode',250);
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
