<?php

use Illuminate\Database\Seeder;

class FixedExpensesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // fixed exp 1 = Etape, 2 = Km, 3 = Hotel, 4 = Resto

        DB::table('fixed_expenses')->insert([
            'name' => 'ETP',
            'display_name' => 'Forfait Etape',
            'amount' => 110.00,
        ]);

        DB::table('fixed_expenses')->insert([
            'name' => 'KM',
            'display_name' => 'Frais Kilométrique',
            'amount' => 0.62,
        ]);

        DB::table('fixed_expenses')->insert([
            'name' => 'NUI',
            'display_name' => 'Nuitée Hôtel',
            'amount' => 80.00,
        ]);

        DB::table('fixed_expenses')->insert([
            'name' => 'REP',
            'display_name' => 'Repas Restaurant',
            'amount' => 25.00,
        ]);
    }
}
