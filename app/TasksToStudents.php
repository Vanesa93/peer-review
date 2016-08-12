<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TasksToStudents extends Model {

    protected $table = 'task_to_users';
    protected $fillable = ['task_id', 'group_id', 'student_id','ready'];

}
