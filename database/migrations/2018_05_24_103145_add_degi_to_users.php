<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDegiToUsers extends Migration
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
        $table->string('degi')->after('previous_institute');
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
        $table->string('degi');
        });
    }
}
