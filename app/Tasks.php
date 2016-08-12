<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model {

    protected $table = 'tasks';
    protected $fillable = ['name', 'description', 'end_date','sent_at'];

}
