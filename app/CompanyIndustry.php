<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CompanyProfile;

class CompanyIndustry extends Model
{
    function CompanyProfile(){
        return $this->hasOne(CompanyProfile::class);
    }
}
