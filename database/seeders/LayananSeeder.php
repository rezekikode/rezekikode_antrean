<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('layanans')->insert([
            'layanan' => 'Pelanggan 1',
            'status' => 'aktif'
        ]);

        DB::table('layanans')->insert([
            'layanan' => 'Pelanggan 2',
            'status' => 'aktif'
        ]);

        DB::table('layanans')->insert([
            'layanan' => 'Pelanggan 3',
            'status' => 'tidak_aktif'
        ]);
    }
}
