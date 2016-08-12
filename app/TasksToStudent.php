<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model {

    protected $table = 'tasks_to_groups';
    protected $fillable = ['task_id', 'group_id', 'user_id','ready','course_id'];

}
