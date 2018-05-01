<?php

use Illuminate\Database\Seeder;

class OfficesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('offices')->insert([
            'street_number' => 27,
            'street_name' => 'Boulevard Montebello',
            'city' => 'Lille',
            'zip_code' => 59000,
            'created_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('offices')->insert([
            'street_number' => 166,
            'street_name' => 'Rue Pierre Mauroy',
            'city' => 'Lille',
            'zip_code' => 59000,
            'created_at' => \Carbon\Carbon::now(),
        ]);
    }
}
