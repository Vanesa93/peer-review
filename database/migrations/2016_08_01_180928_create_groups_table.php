<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('groups', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('tutor_id');
            $table->string('course_id');
            $table->string('faculty_id');
            $table->string('major_id');
            $table->string('student_first_year');            
            $table->timestamps();
        });

        Schema::create('groups_to_students', function(Blueprint $table) {
            $table->increments('id');
            $table->string('student_id');
            $table->string('group_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('groups');
        Schema::drop('groups_to_students');
    }

}
