<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

    protected $table = 'groups';
    protected $fillable = ['name','tutor_id', 'faculty_id','course_id', 'major_id','student_first_year'];

}
