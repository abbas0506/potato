<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bise;

class BiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Bise::create(['name' => 'Sahiwal']);
        Bise::create(['name' => 'Multan']);
        Bise::create(['name' => 'Lahore']);
        Bise::create(['name' => 'Rawalpindi']);
        Bise::create(['name' => 'Faisalabad']);
        Bise::create(['name' => 'Gujranwala']);
        Bise::create(['name' => 'Bahawalpur']);
        Bise::create(['name' => 'D.G.Khan']);
        Bise::create(['name' => 'Sargodha']);
    }
}