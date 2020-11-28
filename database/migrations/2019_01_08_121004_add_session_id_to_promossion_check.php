<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSessionIdToPromossionCheck extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
    {
        Schema::table('promossion_check', function($table) {
        $table->integer('session_id')->length(11)->unsigned()->after('id');
        $table->foreign('session_id')->references('id')->on('session')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    Schema::table('promossion_check', function($table) {
       $table->dropColumn('session_id');
        });
    }
}
