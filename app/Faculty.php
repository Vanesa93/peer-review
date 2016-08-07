<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model {

    protected $table = 'faculties';
    protected $fillable = ['bg_name', 'en_name', 'de_name'];

}
