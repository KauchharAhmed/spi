<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveStudentIDFromPromossionCheck extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
 public function up()
    {
        Schema::table('promossion_check', function (Blueprint $table) {
       $table->dropColumn('studentID');
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
        Schema::table('promossion_check', function (Blueprint $table) {
       $table->string('studentID');
});
    }

}
