<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // 1 = cloturé, 2 = saisie en cours, 3 = remboursé, 4 = validée mise en paiement

        DB::table('states')->insert([
            'name' => 'CL',
            'display_name' => 'Sasie clôturée',
        ]);

        DB::table('states')->insert([
            'name' => 'CR',
            'display_name' => 'Fiche créée, saisie en cours',
        ]);

        DB::table('states')->insert([
            'name' => 'RB',
            'display_name' => 'Remboursée',
        ]);

        DB::table('states')->insert([
            'name' => 'VA',
            'display_name' => 'Validée et mise en paiement',
        ]);
    }
}
