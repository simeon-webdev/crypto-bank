<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'name'      => 'Elliot',
                'email'     => 'elliot@email.com',
                'password'  => Hash::make('password')
            ]
        );

        DB::table('users')->insert(
            [
                'name'      => 'Darlene',
                'email'     => 'darlene@email.com',
                'password'  => Hash::make('password')
            ]
        );
    }
}
