<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClassNoToStudentAttendent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
    {
        // add rfid card colum
        Schema::table('student_attendent', function($table) {
        $table->integer('class_no')->after('day');
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
        Schema::table('student_attendent', function($table) {
        $table->integer('class_no');
         });
    }
}
