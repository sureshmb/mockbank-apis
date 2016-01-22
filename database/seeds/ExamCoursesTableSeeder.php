<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ExamCoursesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
  	$examIds = DB::table('exams')->lists('id');
  	$courseIds = DB::table('courses')->lists('id');
  	$faker = Faker::create();
  	foreach ($examIds as $examId) {
  		$coursesCount = $faker->numberBetween(4,20);
  		$randomKeys = array_rand($courseIds, $coursesCount);
  		foreach ($randomKeys as $randomKey) {
  			DB::table('exam_courses')->insert([
  				'exam_id'	=>	$examId,
  				'course_id'	=>	$courseIds[$randomKey]
  			]);
  		}
  	}
  }
}
