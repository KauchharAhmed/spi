<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           // create department table column
            Schema::create('department', function (Blueprint $table) {
            $table->increments('id',11);
            $table->string('departmentName',250)->unique();
            $table->string('departmentShortName',250)->unique();
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
