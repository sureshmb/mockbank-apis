<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CalendarEventsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
  	$faker = Faker::create();
  	foreach (range(1,1000) as $index) {
      DB::table('calendar_events')->insert([
	      'title' 			=> 	$faker->sentence(6),
	      'description' => 	$faker->paragraph(3),
	      'url'					=>	$faker->url,
	      'eve_date' 		=>	$faker->dateTimeBetween('-1 years', '+2 years'),
	      'category'		=>	$faker->randomElement(['MockBank','External']),
	      'tentative'		=>	$faker->randomElement([0,1]),
	      'exams_slug'	=>	$faker->slug
      ]);
    } 
  }
}
