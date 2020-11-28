<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToDepartment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         // add status colum
        Schema::table('department', function($table) {
        $table->tinyInteger('status')->after('departmentShortName');
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
       Schema::table('department', function($table) {
        $table->tinyInteger('status');
        });
    }
}
