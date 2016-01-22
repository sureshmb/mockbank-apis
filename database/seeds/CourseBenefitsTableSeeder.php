<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class CourseBenefitsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
  	//$courses = DB::table('courses')->get();
  	$faker = Faker::create();
  	$courses = DB::table('courses')->get();
		$benefitIds = DB::table('benefits')->lists('id');
		foreach ($courses as $course) {
			$randomKeys = array_rand($benefitIds, 4);
			foreach($randomKeys as $randomKey) {
				DB::table('course_benefits')->insert([
					'course_id'		=>	$course->id,
					'benefit_id'	=>	$benefitIds[$randomKey],
					'credit_type'	=>	'duration',
					'credits'			=>	$faker->randomElement(['365','150','120','15','60']),
					'price'				=>	$course->price
				]);
			}
		}
  }

}
