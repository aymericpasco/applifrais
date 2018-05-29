<?php

use Illuminate\Database\Seeder;

class FixedExpenseRowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // fixed exp 1 = Etape, 2 = Km, 3 = Hotel, 4 = Resto

        DB::table('fixed_expense_rows')->insert([
            'quantity' => 105,
            'expense_sheet_id' => 1,
            'fixed_expense_id' => 2
        ]);

        DB::table('fixed_expense_rows')->insert([
            'quantity' => 2,
            'expense_sheet_id' => 1,
            'fixed_expense_id' => 3
        ]);

        DB::table('fixed_expense_rows')->insert([
            'quantity' => 4,
            'expense_sheet_id' => 2,
            'fixed_expense_id' => 4
        ]);

        DB::table('fixed_expense_rows')->insert([
            'quantity' => 71,
            'expense_sheet_id' => 2,
            'fixed_expense_id' => 2
        ]);

        DB::table('fixed_expense_rows')->insert([
            'quantity' => 3,
            'expense_sheet_id' => 3,
            'fixed_expense_id' => 1
        ]);
    }
}
