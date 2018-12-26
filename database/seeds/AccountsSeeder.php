<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert(
            [
                'address'           => strtoupper('0x' . sha1(uniqid())),
                'balance'           => 100,
                'interest_rate_id'  => 1,
            ]
        );

        DB::table('account_user')->insert(
            [
                'user_id'           => 1,
                'account_id'           => 1
            ]
        );


        DB::table('accounts')->insert(
            [
                'address'           => strtoupper('0x' . sha1(uniqid())),
                'balance'            => 1000,
                'interest_rate_id'  => 1,
            ]
        );

        DB::table('account_user')->insert(
            [
                'user_id'           => 1,
                'account_id'           => 2
            ]
        );

        DB::table('accounts')->insert(
            [
                'address'           => strtoupper('0x' . sha1(uniqid())),
                'balance'            => 200,
                'interest_rate_id'  => 1,
            ]
        );

        DB::table('account_user')->insert(
            [
                'user_id'           => 2,
                'account_id'           => 3
            ]
        );

        DB::table('accounts')->insert(
            [
                'address'           => strtoupper('0x' . sha1(uniqid())),
                'balance'            => 2000,
                'interest_rate_id'  => 1,
            ]
        );

        DB::table('account_user')->insert(
            [
                'user_id'           => 2,
                'account_id'           => 4
            ]
        );
    }
}
