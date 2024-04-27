<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PemetaanAntreanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pemetaan_antreans')->insert([
            'lokasi_id' => 1,
            'layanan_id' => 1,
            'loket_id' => 1,
            'status' => 'aktif'
        ]);

        DB::table('pemetaan_antreans')->insert([
            'lokasi_id' => 1,
            'layanan_id' => 2,
            'loket_id' => 1,
            'status' => 'aktif'
        ]);

        DB::table('pemetaan_antreans')->insert([
            'lokasi_id' => 1,
            'layanan_id' => 3,
            'loket_id' => 1,
            'status' => 'aktif'
        ]);
    }
}
