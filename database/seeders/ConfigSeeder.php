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
            'weightreductionperbori' => 2,
            'weightreductionpertora' => 0.5,
            'commissionperbori' => 20,
            'commissionpertora' => 10,
            'materialcostperbori' => 10,
            'materialcostpertora' => 10,
            'packingcostperbori' => 10,
            'packingcostpertora' => 10,
            'loadingcostperbori' => 10,
            'loadingcostpertora' => 10,
        ]);
    }
}