<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class VisitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // visitor 1 -> doctors : 1, 2, 5
        // visitor 2 -> doctors : 3, 4


        DB::table('visits')->insert([
            'visit_date' => Carbon::createFromDate(2018, 4, 12),
            'appointment' => true,
            'arriving_time' =>
                Carbon::create(0, 0, 0, 14, 15, 0)->toTimeString(),
            'start_time_interview' =>
                Carbon::create(0, 0, 0, 14, 32, 0)->toTimeString(),
            'departure_time' =>
                Carbon::create(0, 0, 0, 15, 24, 0)->toTimeString(),
            'user_id' => 1, // aymeric pasco
            'doctor_id' => 1 // guillaume braconnier
        ]);

        DB::table('visits')->insert([
            'visit_date' => Carbon::createFromDate(2018, 5, 22),
            'appointment' => false,
            'arriving_time' =>
                Carbon::create(0, 0, 0, 9, 7, 0)->toTimeString(),
            'start_time_interview' =>
                Carbon::create(0, 0, 0, 9, 28, 0)->toTimeString(),
            'departure_time' =>
                Carbon::create(0, 0, 0, 10, 53, 0)->toTimeString(),
            'user_id' => 1,
            'doctor_id' => 5
        ]);

        DB::table('visits')->insert([
            'visit_date' => Carbon::createFromDate(2018, 5, 4),
            'appointment' => true,
            'arriving_time' =>
                Carbon::create(0, 0, 0, 16, 1, 0)->toTimeString(),
            'start_time_interview' =>
                Carbon::create(0, 0, 0, 16, 9, 0)->toTimeString(),
            'departure_time' =>
                Carbon::create(0, 0, 0, 17, 22, 0)->toTimeString(),
            'user_id' => 2,
            'doctor_id' => 4
        ]);


    }
}
