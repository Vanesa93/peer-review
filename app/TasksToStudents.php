<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TasksToStudents extends Model {

    protected $table = 'task_to_students';
    protected $fillable = ['task_id', 'student_id','ready'];

}
