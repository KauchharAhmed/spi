<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStudentTypeToStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
    {
        Schema::table('student', function($table) {
        $table->tinyInteger('student_type')->after('activity_status')->comment = "0=admimitted student  2=readmitted student";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    Schema::table('student', function($table) {
       $table->dropColumn('student_type');
        });
    }
}
