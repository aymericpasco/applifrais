<?php

use Illuminate\Database\Seeder;

class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('doctors')->insert([
            'firstname' => "Guillaume",
            'lastname' => "Braconnier",
            'phone' => "03 20 85 18 18",
            'user_id' => 1,
            'office_id' => 1
        ]);

        DB::table('doctors')->insert([
            'firstname' => "Bruno",
            'lastname' => "Dumont",
            'phone' => "03 20 54 83 81",
            'user_id' => 1,
            'office_id' => 2
        ]);

        DB::table('doctors')->insert([
            'firstname' => "Olivier",
            'lastname' => "Wauquier",
            'phone' => "03 20 47 00 57",
            'user_id' => 1,
            'office_id' => 1
        ]);

        DB::table('doctors')->insert([
            'firstname' => "Adrien",
            'lastname' => "Dauzat",
            'phone' => "03 28 33 15 15",
            'user_id' => 2,
            'office_id' => 2
        ]);

        DB::table('doctors')->insert([
            'firstname' => "Patrick",
            'lastname' => "Rimetz",
            'phone' => "03 20 57 29 34",
            'user_id' => 2,
            'office_id' => 1
        ]);

        DB::table('doctors')->insert([
            'firstname' => "Corinne",
            'lastname' => "Auslender",
            'phone' => "03 20 74 97 87",
            'user_id' => 2,
            'office_id' => 2
        ]);
    }
}
