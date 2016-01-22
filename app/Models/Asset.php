<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
  protected $guarded = ['id'];

  // public function courses() {
  // 	return $this->belongsToMany('App\Models\Course','exam_courses');		
  // }
}
