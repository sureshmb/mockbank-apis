<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendarEvent extends Model
{
  protected $guarded = ['id'];

  // public function courses() {
  // 	return $this->belongsToMany('App\Models\Course','exam_courses');		
  // }

  // public function assets() {
  // 	return $this->belongsToMany('App\Models\Asset','exam_assets');	
  // }

  // public function events() {
  // 	return $this->belongsToMany('App\Models','exam_assets');	
  // }
}
