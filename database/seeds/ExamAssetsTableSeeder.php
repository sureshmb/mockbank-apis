<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ExamAssetsTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $faker = Faker::create();
  	$exams = DB::table('exams')->get();
		$assetIds = DB::table('assets')->lists('id');
		foreach ($exams as $exam) {
			$randomKeys = array_rand($assetIds, 30);
			foreach($randomKeys as $randomKey) {
				DB::table('exam_assets')->insert([
					'exam_id'			=>	$exam->id,
					'asset_id'		=>	$assetIds[$randomKey]
				]);
			}
		}
  }
}
