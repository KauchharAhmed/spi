<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTitleToDepartmentHead extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
 public function up()
    {
        // add rfid card colum
        Schema::table('department_head', function($table) {
        $table->tinyInteger('title')->after('teacher_id');
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
        Schema::table('department_head', function($table) {
        $table->tinyInteger('title');
         });
    }
}
