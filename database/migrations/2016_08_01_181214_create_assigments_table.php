<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssigmentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tasks', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('tutor_id');    
            $table->integer('course_id');    
            $table->string('name');
            $table->string('description');
            $table->date('sent_at');
            $table->date('end_date');
            $table->timestamps();
        });
        
        Schema::create('task_to_users', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('task_id');            
            $table->integer('group_id');   
            $table->integer('user_id');  
            $table->integer('ready'); 
            $table->timestamps();
        });
           

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('tasks');
        Schema::drop('task_to_users');
    }

}
