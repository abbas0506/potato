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
            'reductionperbori' => 2,
            'reductionpertora' => 0.5,
            'commissionperbori' => 20,
            'commissionpertora' => 10,
            'bagpriceperbori' => 10,
            'bagpricepertora' => 10,
            'packingcostperbori' => 10,
            'packingcostpertora' => 10,
            'loadingcostperbori' => 10,
            'loadingcostpertora' => 10,
        ]);
    }
}
