<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionaryToStudent extends Model {

    protected $table = 'questionary_to_student';
    protected $fillable = ['student_id_writer','student_id_for_review', 'task_id', 'lecturers_review_id', 'file_for_review', 'sent_at'];

}
