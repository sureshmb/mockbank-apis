<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CalendarEventsExamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$examIds = DB::table('exams')->lists('id');
    	$eventIds = DB::table('calendar_events')->lists('id');
    	$faker = Faker::create();
    	foreach ($examIds as $examId) {
    		$eventsCount = $faker->numberBetween(20, 50);
    		$randomKeys = array_rand($eventIds, $eventsCount);
    		foreach ($randomKeys as $randomKey) {
    			DB::table('calendar_events_exams')->insert([
    				'exam_id'		=>	$examId,
    				'event_id'	=>	$eventIds[$randomKey]
    			]);
    		}
    	}
    }
}
