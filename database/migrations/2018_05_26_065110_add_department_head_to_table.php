<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDepartmentHeadToTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // cratet department head table
           Schema::create('department_head', function (Blueprint $table) {
            $table->increments('id',11);
            $table->string('login_id',250)->unique();
            $table->string('password',250);
            $table->intger('dep_id',11);
            $table->foreign('dep_id')->references('id')->on('department')->onDelete('restrict')->onUpdate('cascade');
            $table->intger('teacher_id',11);
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->tinyInteger('type');
            $table->tinyInteger('status');
            $table->string('recover_code',100);
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
