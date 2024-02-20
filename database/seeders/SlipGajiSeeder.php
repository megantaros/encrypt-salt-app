<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SlipGajiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\SlipGaji::create([
            'gaji_pokok' => 5000000,
            'tgl_gaji' => now(),
        ]);
    }
}