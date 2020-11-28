<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSemisterStatusStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student', function($table) {
        $table->tinyInteger('semister_status')->after('registration')->comment = "1=active semister 2=inactive semister";
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
         $table->tinyInteger('semister_status');
         });
    }
}
