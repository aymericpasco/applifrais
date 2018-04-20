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
        DB::table('expense_sheets')->insert([
            'created_at' => Carbon::createFromDate(2018, 03, 12),
            'user_id' => 1, // user id = 1 est "lvillechalane@local.dev"
            'state_id' => 1, // state id = 1 est "Sasie clôturée"
        ]);

        DB::table('expense_sheets')->insert([
            'created_at' => Carbon::now(),
            'user_id' => 1, // user id = 1 est "lvillechalane@local.dev"
            'state_id' => 2, // state id = 2 est "Fiche créée, saisie en cours"
        ]);

        DB::table('expense_sheets')->insert([
            'created_at' => Carbon::createFromDate(2018, 04, 10),
            'user_id' => 3, // user id = 1 est "lvillechalane@local.dev"
            'state_id' => 2, // state id = 2 est "Fiche créée, saisie en cours"
        ]);
    }
}
