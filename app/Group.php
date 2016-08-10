<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model {

    protected $table = 'groups';
    protected $fillable = ['tutor_id', 'faculty_id', 'major_id','year'];

}
