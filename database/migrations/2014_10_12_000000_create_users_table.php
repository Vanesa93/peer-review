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
        Schema::create('faculties', function(Blueprint $table) {
            $table->increments('id');
            $table->string('bg_name');
            $table->string('en_name');
            $table->string('de_name');
            $table->timestamps();
        });

        Schema::create('majors', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('faculty_id')->unsigned();
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade')->onUpdate('cascade');
            $table->string('bg_name');
            $table->string('en_name');
            $table->string('de_name');
            $table->timestamps();
        });


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
            $table->integer('year')->nullable();
            $table->integer('semester')->nullable();
            $table->integer('group')->nullable();
            $table->string('mobile');
            $table->integer('faculty')->unsigned();
            $table->foreign('faculty')->references('id')->on('faculties')->onDelete('cascade')->onUpdate('cascade');
            $table->string('major');
            $table->string('degree');
            $table->string('profilePhoto')->nullable();
            $table->integer('user_id_students')->unsigned();
            $table->foreign('user_id_students')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('lecturer', function(Blueprint $table) {
            $table->increments('id');
            $table->string('mobile');
            $table->string('cabinet')->nullable();
            $table->string('department'); // for students major
            $table->string('degree'); //for students(ex.bachelor)for teahers(ex.prof.)       
            $table->string('profilePhoto')->nullable();
            $table->integer('user_id_lecturer')->unsigned();
            $table->foreign('user_id_lecturer')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('courses', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('tutor_id')->unsigned();
            $table->foreign('tutor_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->string('description');
            $table->string('duration');
            $table->string('requirments');
            $table->string('language');
            $table->timestamps();
        });

        Schema::create('groups', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('tutor_id')->unsigned();
            $table->foreign('tutor_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('course_id')->unsigned();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('faculty_id')->unsigned();
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('major_id')->unsigned();
            $table->foreign('major_id')->references('id')->on('majors')->onDelete('cascade')->onUpdate('cascade');
            $table->string('student_first_year');
            $table->timestamps();
        });

        Schema::create('groups_to_students', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('group_id')->unsigned();
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('groups_to_students');
        Schema::drop('groups');
        Schema::drop('courses');
        Schema::drop('lecturer');
        Schema::drop('students');
        Schema::drop('users');
        Schema::drop('majors');
        Schema::drop('faculties');
    }

}
