<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMajorsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('majors', function(Blueprint $table) {
            $table->increments('id');
            $table->string('faculty_id');
            $table->string('bg_name');
            $table->string('en_name');
            $table->string('de_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('majors');
    }

}
