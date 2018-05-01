<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class);
        $this->call(FixedExpensesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(OfficesTableSeeder::class);
        $this->call(VisitorsTableSeeder::class);
        $this->call(AccountantsTableSeeder::class);
        $this->call(DoctorsTableSeeder::class);
        $this->call(VisitsTableSeeder::class);
        $this->call(ExpenseSheetsTableSeeder::class);
    }
}
