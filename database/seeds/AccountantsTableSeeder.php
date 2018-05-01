<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AccountantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => 'John',
            'lastname' => 'Snow',
            'username' => 'jsnow',
            'email' => 'jsnow@winterfell.com',
            'password' => bcrypt('AzertY!59000'),
            'created_at' => Carbon::now(),
            'role_id' => 2, // role id = 2 est comptable
        ]);
    }
}
