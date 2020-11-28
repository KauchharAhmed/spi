<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubjectStatusToSubject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subject', function($table) {
        $table->tinyInteger('subject_status')->after('status')->comment = "1=regular Subject 2=Optional Subject";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    Schema::table('subject', function($table) {
       $table->dropColumn('subject_status');
        });
    }
}
