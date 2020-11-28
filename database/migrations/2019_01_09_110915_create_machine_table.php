<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMachineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
    {
            Schema::create('machine', function (Blueprint $table) {
            $table->increments('id',11);
            $table->integer('dep_id')->length(11)->unsigned();
            $table->integer('machine_no')->length(11)->unsigned();
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
       Schema::drop('machine');
    }
}
