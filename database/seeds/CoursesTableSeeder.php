<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class CoursesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
  	$faker = Faker::create();
  	foreach (range(1,990) as $index) {
      DB::table('courses')->insert([
        'title' => $faker->sentence(6),
        'price' => $faker->numberBetween(100, 8000),
      ]);
    }
  }
}
