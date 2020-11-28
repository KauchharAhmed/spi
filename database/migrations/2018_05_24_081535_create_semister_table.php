<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemisterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            // create the shift table  column
            Schema::create('semister', function (Blueprint $table) {
            $table->increments('id',11);
            $table->string('semisterName',250)->unique();
            $table->integer('order')->length(10)->unsigned();
            $table->tinyInteger('status');
            $table->mediumText('remarks');
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
