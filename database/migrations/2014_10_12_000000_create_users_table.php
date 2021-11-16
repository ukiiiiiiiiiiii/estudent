<?php

use Illuminate\Support\Facades\Schema;
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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('username')->unique(); //indeks
            $table->string('password'); //jmbg
            /*$table->boolean('budget');
            $table->bigIncrements('course_id')->references('id')->on('courses');
            $table->integer('rank');
            $table->year('enrollment');
            $table->integer('grade');
            $table->integer('espb')->default(0);
            $table->integer('money')->default(0);*/
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
