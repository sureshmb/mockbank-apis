<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
  protected $guarded = ['id'];

  public function benefits() {
  	return $this->belongsToMany('App\Models\Benefit', 'course_benefits');
  }

  public function assets() {
  	return $this->belongsToMany('App\Models\Asset', 'course_assets');	
  }
}
