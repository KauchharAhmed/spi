<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubjectMarksTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('subject_marks_type', function (Blueprint $table) {
            $table->increments('id',11);
            $table->integer('subject_id')->length(11)->unsigned();
            $table->tinyInteger('type')->length(4)->unsigned()->comment = "1=cont theory 2=final theory 3=cont practical 4=final practical";
            $table->string('type_name',100);
            $table->float('marks',40,2);
            $table->tinyInteger('status')->length(4)->unsigned()->comment = "0=active sub 1=Inactive sub";
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
