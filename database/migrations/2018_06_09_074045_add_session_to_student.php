<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSessionToStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
 public function up()
    {
        // Schema::table('student', function($table) {
        // $table->integer('session')->length(11)->unsigned()->after('rfIdCard');
        // $table->foreign('session')->references('id')->on('session')->onDelete('restrict')->onUpdate('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         // Schema::table('student', function($table) {
         // $table->tinyInteger('session');
         // });
    }
}
