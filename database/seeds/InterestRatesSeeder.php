<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InterestRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('interest_rates')->insert(
            [
                'title'      => 'Base',
                'percent'     => 0.01,
            ]
        );
    }
}
