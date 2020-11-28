<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveSessionFromStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
      public function up()
    {
        //
        // Schema::table('student', function (Blueprint $table) {
        // $table->dropColumn('session');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    // Schema::table('student', function (Blueprint $table) {
    // $table->dropColumn('session');
//});
    }
}
