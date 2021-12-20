<?php

namespace Database\Seeders;

use App\Models\Transporter;
use Illuminate\Database\Seeder;

class TransporterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Transporter::create([
            'name' => 'Nasir Transport',
            'phone' => '0343-4437491',
            'address' => 'Nasir rana, Super market Depalpur',
        ]);

        Transporter::create([
            'name' => 'Ali Akbar',
            'phone' => '0343-4437491',
            'address' => 'Akbar Transport Depalpur',
        ]);
    }
}