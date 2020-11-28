<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHolidayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('holiday', function (Blueprint $table) {
            $table->increments('id',11);
            $table->string('year',10);
            $table->tinyInteger('type')->comment = "1=weekly holiday";
            $table->date('holiday_date');
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
