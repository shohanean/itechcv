<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CompanyIndustry;

class CompanyProfile extends Model
{

    function industry(){
        return $this->belongsTo(CompanyIndustry::class);
    }
    function upazila(){
        return $this->belongsTo(Upazila::class);
    }
    function district(){
        return $this->belongsTo(District::class);
    }
    function country(){
        return $this->belongsTo(Country::class);
    }
    function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

}
