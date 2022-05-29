<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    function country(){
        return $this->belongsTo('App\Country', 'country_id');
    }
}
