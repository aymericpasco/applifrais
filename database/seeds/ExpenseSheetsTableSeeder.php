<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ExpenseSheetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // 1 = cloturé, 2 = saisie en cours, 3 = remboursé, 4 = validée mise en paiement

        DB::table('expense_sheets')->insert([
            'created_at' => Carbon::createFromDate(2018, 3, 12),
            'updated_at' => Carbon::createFromDate(2018, 4, 23),
            'user_id' => 1, // user id = 1 est "apasco"
            'state_id' => 3, // state id = 1 est "Remboursé"
        ]);

        DB::table('expense_sheets')->insert([
            'created_at' => Carbon::createFromDate(2018, 4, 9),
            'updated_at' => Carbon::createFromDate(2018, 5, 3),
            'user_id' => 1, // user id = 1 est "apasco"
            'state_id' => 4, // state id = 1 est "mise en paiement"
        ]);

        DB::table('expense_sheets')->insert([
            'created_at' => Carbon::createFromDate(2018, 5, 7),
            'updated_at' => Carbon::createFromDate(2018, 5, 11),
            'user_id' => 1, // user id = 1 est "apasco"
            'state_id' => 2, // state id = 1 est "mise en paiement"
        ]);


    }
}
