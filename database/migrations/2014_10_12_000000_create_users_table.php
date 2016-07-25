<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('position');
            $table->string('username');
            $table->string('forename'); // first name  
            $table->string('familyName'); // family name
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->integer('mobile');
            $table->string('cabinet')->nullable();
            $table->integer('facNumber')->nullable();
            $table->integer('semester')->nullable();
            $table->integer('group')->nullable();
            $table->string('faculty')->nullable();
            $table->string('department'); // for students major
            $table->string('degree'); //for students(ex.bachelor)for teahers(ex.prof.)       
            $table->string('profilePhoto')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('users');
    }

}
