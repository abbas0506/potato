<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Section::create(['name' => 'XI-A']);
        Section::create(['name' => 'XI-B']);
        Section::create(['name' => 'XI-C']);
    }
}