<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TunjanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        \App\Models\Tunjangan::create([
            'nama_tunjangan' => 'Tunjangan Perjalanan',
            'jumlah_tunjangan' => 1000000
        ]);

        \App\Models\Tunjangan::create([
            'nama_tunjangan' => 'Tunjangan Anak',
            'jumlah_tunjangan' => 500000
        ]);

        \App\Models\Tunjangan::create([
            'nama_tunjangan' => 'Tunjangan Pajak',
            'jumlah_tunjangan' => 2000000
        ]);

        \App\Models\Tunjangan::create([
            'nama_tunjangan' => 'Tunjangan Lainnya',
            'jumlah_tunjangan' => 3000000
        ]);
    }
}