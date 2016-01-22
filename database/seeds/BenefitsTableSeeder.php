<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BenefitsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
  	$faker = Faker::create();
  	foreach (range(1,1010) as $index) {
      DB::table('benefits')->insert([
        'title' => $faker->sentence(3),
        'description' => $faker->paragraph(3)
      ]);
    }
  }
}
