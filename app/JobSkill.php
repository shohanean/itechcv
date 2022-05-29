<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobSkill extends Model
{
    function skill(){
        return $this->belongsTo('App\Skill', 'skill_id');
    }
}
