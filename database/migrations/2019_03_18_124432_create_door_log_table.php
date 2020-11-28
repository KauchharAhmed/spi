<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoorLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
            Schema::create('door_log', function (Blueprint $table) {
            $table->increments('id',11);
            $table->string('card_no',250);
            $table->tinyInteger('type')->comment="1 = staff 2 = student 3 = guest";
            $table->tinyInteger('user_type');
            $table->integer('enter_id')->length(11)->unsigned();
            $table->string('year',50);
            $table->integer('dep_id')->length(11)->unsigned();
            $table->integer('shift_id')->length(11)->unsigned();
            $table->integer('semister_id')->length(11)->unsigned();
            $table->integer('section_id')->length(11)->unsigned();
            $table->time('enter_time');
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
       Schema::drop('door_log');
    }
}
