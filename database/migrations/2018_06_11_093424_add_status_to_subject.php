<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToSubject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        // add rfid card colum
        Schema::table('subject', function($table) {
        $table->tinyInteger('status')->after('practical_marks')->comment = "0=active 1=inactive";
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
        Schema::table('subject', function($table) {
        $table->tinyInteger('status');
         });
    }
}
