<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('grades', function(Blueprint $table) {
            $table->increments('id');         
            $table->integer('task_id')->unsigned();
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('grade');
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
        Schema::drop('grades');
    }

}
