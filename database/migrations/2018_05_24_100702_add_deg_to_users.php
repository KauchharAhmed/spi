<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDegToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
    {
         // add deg colum
        Schema::table('users', function($table) {
        $table->string('deg')->after('previous_institute');
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
       Schema::table('users', function($table) {
        $table->string('deg');
        });
    }
}
