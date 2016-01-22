<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
//use DB;

use Faker\Factory as Faker;

class ExamsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
  	$faker = Faker::create();
  	foreach (range(1,101) as $index) {
      DB::table('exams')->insert([
          'title' => $faker->sentence(6),
          'description' => $faker->paragraph(3),
          'url' => $faker->url,
          'image' =>	$faker->word.'.jpg',
          'info'	=>	$faker->paragraph(5),
          'type'	=>	$faker->randomElement(['Upcoming~Popular','Popular','Upcoming'])
      ]);
    }  
  }
}
