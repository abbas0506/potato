<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert(
            [
                [
                    'userid' => 'admin',
                    'password' => Hash::make('password')
                ],
                [
                    'userid' => 'user',
                    'password' => Hash::make('password')
                ]
            ]
        );
    }
}