<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('setting', function (Blueprint $table) {
            $table->increments('id',11);
            $table->string('full_name',250);
            $table->string('short_name',250);
            $table->string('mobile',250);
            $table->string('phone',250);
            $table->string('email',250);
            $table->mediumText('address');
            $table->string('image',250);
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
