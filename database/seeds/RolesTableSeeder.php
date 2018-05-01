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
        DB::table('roles')->insert([
            'display_name' => "Visiteur",
            'name' => str_slug("Visiteur", "-"),
        ]);

        DB::table('roles')->insert([
            'display_name' => "Comptable",
            'name' => str_slug("Comptable", "-"),
        ]);
    }
}
