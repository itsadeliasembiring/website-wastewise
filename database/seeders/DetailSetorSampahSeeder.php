<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailSetorSampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('detail_setor')->insert([
            'id_detail' => 'D001',
            'berat_kg' => 5.0,
            'id_setor' => 'S00001', // diperbaiki dari S000001
            'id_sampah' => 'S01',
        ]);
        
        DB::table('detail_setor')->insert([
            'id_detail' => 'D002',
            'berat_kg' => 3.0,
            'id_setor' => 'S00001', // diperbaiki dari S000001
            'id_sampah' => 'S02',
        ]);
        
        DB::table('detail_setor')->insert([
            'id_detail' => 'D003',
            'berat_kg' => 7.5,
            'id_setor' => 'S00002', // diperbaiki dari S000002
            'id_sampah' => 'S03',
        ]);
        
        DB::table('detail_setor')->insert([
            'id_detail' => 'D004',
            'berat_kg' => 4.0,
            'id_setor' => 'S00002', // diperbaiki dari S000002
            'id_sampah' => 'S01',
        ]);
    }
}
