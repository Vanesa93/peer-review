<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model {

    protected $table = 'tasks';
    protected $fillable = ['name', 'description', 'group_id','end_date','sent_at','tutor_id','course_id'];

}
