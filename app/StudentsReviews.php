<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentsReviews extends Model {						
    protected $table = 'students_reviews';
    protected $fillable = ['student_id_writer','student_id_for_review', 'task_id', 'questionary_to_student_id',
        'extension', 'filename','mime','original_filename','sent_at'];

}
