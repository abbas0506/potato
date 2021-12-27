<?php

namespace Database\Seeders;

use App\Models\Config;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Config::create([
            'reduction0' => 2,
            'reduction1' => 0.5,
            'commission0' => 20,
            'commission1' => 10,
            'bagprice0' => 10,
            'bagprice1' => 10,
            'packing0' => 10,
            'packing1' => 10,
            'loading0' => 10,
            'loading1' => 10,
        ]);
    }
}
