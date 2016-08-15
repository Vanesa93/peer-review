<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LecturersReviews extends Model {

    protected $table = 'lecturers_reviews';
    protected $fillable = ['tutor_id', 'task_id','end_date','sent_at','file_id'];

}
