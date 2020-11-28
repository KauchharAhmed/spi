<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTrasferStatusToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         // add transfer status column
        Schema::table('users', function($table) {
        $table->tinyInteger('trasfer_status')->after('index_no');
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
        $table->tinyInteger('trasfer_status');
        });
    }
}
