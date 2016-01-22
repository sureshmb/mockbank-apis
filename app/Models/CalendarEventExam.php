<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendarEventExam extends Model
{
  protected $table = 'calendar_events_exams';
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
