<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
    use SoftDeletes;

    function degree(){
        return $this->belongsTo('App\Degree', 'degree_id');
    }
    function degreeTitle(){
        return $this->belongsTo('App\DegreeTitle', 'degree_title_id');
    }
    function board(){
        return $this->belongsTo('App\Board', 'board_id');
    }
}
