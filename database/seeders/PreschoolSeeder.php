<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Preschool;

class PreschoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Preschool::create(['name' => 'GHS Chak Bedi, Pakpattan']);
        Preschool::create(['name' => 'GHS Bunga Hayat, Pakpattan']);
        Preschool::create(['name' => 'GHS 23/SP, Pakpattan']);
    }
}