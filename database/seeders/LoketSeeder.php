<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LoketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lokets')->insert([
            'loket' => 'Loket 1',
            'status' => 'aktif'
        ]);

        DB::table('lokets')->insert([
            'loket' => 'Loket 2',
            'status' => 'aktif'
        ]);

        DB::table('layanan_loket')->insert([
            'layanan_id' => 1,
            'loket_id' => 1            
        ]);

        DB::table('layanan_loket')->insert([
            'layanan_id' => 2,
            'loket_id' => 1,            
        ]);
    }
}
