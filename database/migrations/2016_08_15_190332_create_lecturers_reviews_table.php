<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLecturersReviewsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('lecturers_reviews', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('tutor_id')->unsigned();
            $table->foreign('tutor_id')->references('id')->on('lecturer')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('task_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('file_id')->unsigned();
            $table->foreign('file_id')->references('id')->on('fileentries_lecturers')->onDelete('cascade')->onUpdate('cascade');
            $table->string('description');
            $table->date('end_date');
            $table->date('sent_at');
            $table->integer('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('lecturers_reviews');
    }

}
