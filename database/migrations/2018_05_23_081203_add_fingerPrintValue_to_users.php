<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFingerPrintValueToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         // add rfid card colum
        Schema::table('users', function($table) {
        $table->integer('fingerPrintValue')->after('rfidCardNo');
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
        $table->integer('fingerPrintValue');
        });
    }
}
