<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransferStatusStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
    {
        Schema::table('student', function($table) {
        $table->tinyInteger('transfer_status')->after('semister_status')->comment = "0=not trasfer status 1=transfer status";
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
         $table->tinyInteger('transfer_status');
         });
    }
}
