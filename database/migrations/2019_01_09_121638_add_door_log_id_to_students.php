<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDoorLogIdToStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
    {
        Schema::table('students', function($table) {
        $table->string('door_log_id',250)->after('rfIdNumber');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    Schema::table('students', function($table) {
       $table->dropColumn('door_log_id');
    });
    }
}
