<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('leave', function (Blueprint $table) {
            $table->increments('id',11);
            $table->integer('user_id')->length(11)->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->string('application_person',100);
            $table->tinyInteger('leave_type')->length(4)->unsigned();
            $table->tinyInteger('application_type')->length(4)->unsigned()->comment = "1=before leave 2=after leave";
            $table->date('request_from');
            $table->date('request_to');
            $table->longText('application');
            $table->tinyInteger('day')->length(4)->unsigned();
            $table->date('final_request_from');
            $table->date('final_request_to');
            $table->tinyInteger('final_day')->length(4)->unsigned();
            $table->tinyInteger('status')->length(4)->unsigned()->comment = "1=approved 2=rejected";
            $table->date('created_at');
            $table->date('modified_at');
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
    }
}
