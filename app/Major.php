<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Major extends Model {

    protected $table = 'majors';
    protected $fillable = ['bg_name', 'en_name', 'de_name'];

}
