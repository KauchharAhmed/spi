<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student', function($table) {
        $table->tinyInteger('status')->after('semister_status')->comment = "0=active student 1=inactive student";
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
         $table->tinyInteger('status');
         });
    }
}
