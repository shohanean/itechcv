<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    function PersonalInformation(){
        return $this->hasMany(District::class);
    }
}
