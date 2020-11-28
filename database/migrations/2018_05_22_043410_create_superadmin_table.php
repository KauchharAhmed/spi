<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuperadminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('superadmin', function (Blueprint $table) {
            $table->increments('id',11);
            $table->string('name',250);
            $table->string('email',250)->unique();
            $table->string('mobile',20)->unique();
            $table->tinyInteger('status');
            $table->string('password',250);
            $table->string('recover_code',100);
            $table->rememberToken();
            $table->timestamps();
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
