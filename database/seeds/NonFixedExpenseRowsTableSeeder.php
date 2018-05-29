<?php

use Illuminate\Database\Seeder;

class NonFixedExpenseRowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('non_fixed_expense_rows')->insert([
            'wording' => "Parking",
            'amount' => 13.63,
            'expense_date' => Carbon\Carbon::createFromDate(2018, 3, 20),
            'expense_sheet_id' => 1
        ]);

        DB::table('non_fixed_expense_rows')->insert([
            'wording' => "Péages",
            'amount' => 27.86,
            'expense_date' => \Carbon\Carbon::createFromDate(2018, 4, 12),
            'expense_sheet_id' => 2
        ]);

        DB::table('non_fixed_expense_rows')->insert([
            'wording' => "Parking",
            'amount' => 22.48,
            'expense_date' => \Carbon\Carbon::createFromDate(2018, 5, 10),
            'expense_sheet_id' => 3
        ]);
    }
}
