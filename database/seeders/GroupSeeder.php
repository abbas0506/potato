<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Group::create(['name' => 'Pre Medical', 'fee' => 3000,]);
        Group::create(['name' => 'Pre Engg.', 'fee' => 3000,]);
        Group::create(['name' => 'ICS', 'fee' => 3000,]);
        Group::create(['name' => 'Arts', 'fee' => 2800,]);
    }
}