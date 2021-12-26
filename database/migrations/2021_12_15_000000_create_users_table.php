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
            $table->unsignedBigInteger('program_id')->index();
            $table->string('name');
            $table->string('username')->unique(); //indeks
            $table->string('password'); //jmbg
            $table->char('budget', '1');
            $table->smallInteger('rank');
            $table->smallInteger('grade')->default(1);
            $table->smallInteger('espb')->default(0);
            $table->integer('money')->default(0);
            $table->integer('paid')->default(0);
            $table->rememberToken();

            $table->foreign('program_id')->references('id')->on('programs')->onDelete('cascade');
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
