<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            // create user table 
            Schema::create('users', function (Blueprint $table) {
            $table->increments('id',11);
            $table->string('login_id',250)->unique();
            $table->string('name',250);
            $table->string('email',250)->unique();
            $table->string('mobile',20)->unique();
            $table->tinyInteger('type');
            $table->string('password',250);
            $table->date('joinig_date');
            $table->mediumText('education_info');
            $table->string('previous_institute',250);
            $table->string('index_no',250);
            $table->string('recover_code',100);
            $table->string('image',100);
            $table->string('noc',100);
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
