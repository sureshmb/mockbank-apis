<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AssetsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
 		$faker = Faker::create();
 		foreach (range(1,205) as $index) {
 	    DB::table('assets')->insert([
        'title' => $faker->sentence(6),
        'description' => $faker->paragraph(3),
        'url' => $faker->url,
        'thumbnail_url'	=>	$faker->url,
        'author'	=>	$faker->name,
        'author_url'	=>	$faker->url,
        'author_thumbnail' =>	$faker->word.'.jpg',
        'content_type'	=>	$faker->randomElement(['Video','Doc']),
        'asset_type'		=>	$faker->randomElement(['Testimonial','Product Video','Doubt Solving Video'])
 	    ]);
 	  }
  }
}
