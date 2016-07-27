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
            $table->integer('account_type');
            $table->string('username');
            $table->string('forename'); // first name  
            $table->string('familyName'); // family name
            $table->string('email')->unique();
            $table->string('password', 60);            
            $table->rememberToken();
            $table->timestamps();
        });


        Schema::create('students', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('facNumber')->nullable();
            $table->integer('semester')->nullable();
            $table->integer('group')->nullable();
            $table->integer('mobile');
            $table->string('faculty')->nullable();
            $table->string('department'); // for students major
            $table->string('degree'); //for students(ex.bachelor)for teahers(ex.prof.)       
            $table->string('profilePhoto')->nullable();
            $table->integer('user_id_students')->unsigned();
            $table->foreign('user_id_students')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('lecturer', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('mobile');
            $table->string('cabinet')->nullable();
            $table->string('department'); // for students major
            $table->string('degree'); //for students(ex.bachelor)for teahers(ex.prof.)       
            $table->string('profilePhoto')->nullable();
            $table->integer('user_id_lecturer')->unsigned();
            $table->foreign('user_id_lecturer')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        Schema::drop('lecturer');
        Schema::drop('students');
        Schema::drop('users');
    }

}
