<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalInformation extends Model
{
    protected $fillable = [
        'father_name',
        'mother_name',
        'gender',
        'phone',
        'present_address',
        'district_id',
        'upazila_id',
        'permanent_address',
        'pdistrict_id',
        'pupazila_id',
        'is_student',
        'job_category',
        'nid',
        'dob',
        'marital_status',
        'user_profile',
        'designation',
        'job_status',
        'interested_location',
    ];

    function district(){

        return $this->belongsTo('App\District', 'district_id');
    }
    function pdistrict(){

        return $this->belongsTo('App\District', 'pdistrict_id');
    }
    function upazila(){

        return $this->belongsTo('App\Upazila', 'upazila_id');
    }
    function pupazila(){

        return $this->belongsTo('App\Upazila', 'pupazila_id');
    }
    function skill(){

        return $this->belongsTo('App\Skill', 'skill_id');
    }

    function user(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
