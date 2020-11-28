<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSessionIdToPromossionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
    {
        Schema::table('promossion', function($table) {
        $table->integer('session_id')->length(11)->unsigned()->after('id');
        $table->foreign('session_id')->references('id')->on('session')->onDelete('restrict')->onUpdate('cascade');
        $table->string('registration',250)->after('roll');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    Schema::table('promossion', function($table) {
       $table->dropColumn('session_id');
       $table->dropColumn('registration');
        });
    }
}
