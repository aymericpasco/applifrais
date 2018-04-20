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
            'firstname' => 'Aymeric',
            'lastname' => 'Pasco',
            'email' => 'apasco@local.dev',
            'password' => bcrypt('comptable59'),
            'created_at' => Carbon::now(),
            'role_id' => 2, // role id = 2 est comptable
        ]);
    }
}
