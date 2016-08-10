<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupToStudent extends Model {

    protected $table = 'groups_to_students';
    protected $fillable = ['group_id', 'student_id'];

}
