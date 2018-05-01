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
            'updated_at' => Carbon::createFromDate(2018, 04, 23),
            'user_id' => 1, // user id = 1 est "apasco"
            'state_id' => 3, // state id = 1 est "Remboursé"
        ]);


    }
}
