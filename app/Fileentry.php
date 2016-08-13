<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fileentry extends Model {

    protected $table = 'fileentries_lecturers';
    protected $fillable = [ 'tutor_id', 'task_id', 'filename', 'mime', 'original_filename'];

}
