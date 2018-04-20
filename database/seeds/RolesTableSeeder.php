<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $visiteur = 'Visiteur';
        $comptable = 'Comptable';

        DB::table('roles')->insert([
            'display_name' => $visiteur,
            'name' => str_slug($visiteur, "-"),
            // 'created_at' => Carbon::now(),
        ]);

        DB::table('roles')->insert([
            'display_name' => $comptable,
            'name' => str_slug($comptable, "-"),
            // 'created_at' => Carbon::now(),
        ]);
    }
}
