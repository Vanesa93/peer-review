<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model {

    protected $table = 'grades';
    protected $fillable = ['task_id','student_id', 'sent_at','grade'];

}
