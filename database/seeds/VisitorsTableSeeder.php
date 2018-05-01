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
            'firstname' => 'Aymeric',
            'lastname' => 'Pasco',
            'username' => 'apasco',
            'email' => 'apasco@gmail.com',
            'password' => bcrypt('AzertY!59000'),
            'address' => '202B rue du Buisson',
            'zip' => '59700',
            'city' => 'Marcq-en-Baroeul',
            'hiring_date' => Carbon::createFromDate(2016, 9, 3),
            'created_at' => Carbon::now(),
            'role_id' => 1, // role id = 1 est visiteur
        ]);


        DB::table('users')->insert([
            'firstname' => 'Julien',
            'lastname' => 'Dupond',
            'username' => 'jdupond',
            'email' => 'jdupond@gmail.com',
            'password' => bcrypt('AzertY!59000'),
            'address' => '19 boulevard Papin',
            'zip' => '59000',
            'city' => 'Lille',
            'hiring_date' => Carbon::createFromDate(2011, 1, 8),
            'created_at' => Carbon::now(),
            'role_id' => 1, // role id = 1 est visiteur
        ]);
    }
}
