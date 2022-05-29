<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CvRequest extends Model
{
    function user(){
      return $this->belongsTo(User::class);
    }
    function district(){
      return $this->belongsTo(District::class, 'location_id');
    }
    function category(){
      return $this->belongsTo(Subject::class, 'category_id');
    }
}
