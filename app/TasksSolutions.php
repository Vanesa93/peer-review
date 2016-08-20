<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TasksSolutions extends Model {

    protected $table = 'tasks_solution';
    protected $fillable = [ 'student_id', 'task_id', 'extension', 'filename', 'sent_at', 'mime','original_filename'];

}
