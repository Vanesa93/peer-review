<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionaryToStudentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('questionary_to_student', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id_writer')->unsigned();
            $table->foreign('student_id_writer')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('task_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('lecturers_review_id')->unsigned();
            $table->foreign('lecturers_review_id')->references('id')->on('lecturers_reviews')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('file_for_review')->unsigned();
            $table->foreign('file_for_review')->references('id')->on('tasks_solution')->onDelete('cascade')->onUpdate('cascade');
            $table->date('sent_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('questionary_to_student');
    }

}
