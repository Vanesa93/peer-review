<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsReviewsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('students_reviews', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id_writer')->unsigned();
            $table->foreign('student_id_writer')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('student_id_for_review')->unsigned();
            $table->foreign('student_id_for_review')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('task_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('questionary_to_student_id')->unsigned();
            $table->foreign('questionary_to_student_id')->references('id')->on('questionary_to_student')->onDelete('cascade')->onUpdate('cascade');
            $table->string('extension');
            $table->string('filename');
            $table->string('mime');
            $table->string('original_filename');
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
        Schema::drop('students_reviews');
    }

}
