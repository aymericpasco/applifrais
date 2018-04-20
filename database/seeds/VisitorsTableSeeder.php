<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Role;

class VisitorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'firstname' => 'Louis',
            'lastname' => 'Villechalane',
            'email' => 'lvillechalane@local.dev',
            'password' => bcrypt('jux7g'),
            'address' => '8 rue des Charmes',
            'zip' => '46000',
            'city' => 'Cahors',
            'hiring_date' => Carbon::createFromDate(2005, 12, 21),
            'created_at' => Carbon::now(),
            'role_id' => 1, // role id = 1 est visiteur
        ]);


        DB::table('users')->insert([
            'firstname' => 'David',
            'lastname' => 'Andre',
            'email' => 'dandre@local.dev',
            'password' => bcrypt('oppg5'),
            'address' => '1 rue Petit',
            'zip' => '46200',
            'city' => 'Lalbenque',
            'hiring_date' => Carbon::createFromDate(1998, 11, 23),
            'created_at' => Carbon::now(),
            'role_id' => 1, // role id = 1 est visiteur
        ]);

        DB::table('users')->insert([
            'firstname' => 'Christian',
            'lastname' => 'Bedos',
            'email' => 'cbodes@local.dev',
            'password' => bcrypt('gmhxd'),
            'address' => '1 rue Peranud',
            'zip' => '46250',
            'city' => 'Montcuq',
            'hiring_date' => Carbon::createFromDate(1995, 01, 12),
            'created_at' => Carbon::now(),
            'role_id' => 1, // role id = 1 est visiteur
        ]);
    }
}
