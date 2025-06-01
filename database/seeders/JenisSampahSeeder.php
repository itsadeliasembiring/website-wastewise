<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisSampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_sampah')->insert([
            [
                'id_jenis_sampah' => 'J01',
                'nama_jenis_sampah' => 'Organik',
                'warna_tempat_sampah' => 'Hijau',
            ],
            [
                'id_jenis_sampah' => 'J02',
                'nama_jenis_sampah' => 'Anorganik',
                'warna_tempat_sampah' => 'Kuning',
            ],
            [
                'id_jenis_sampah' => 'J03',
                'nama_jenis_sampah' => 'B3',
                'warna_tempat_sampah' => 'Merah',
            ],
        ]);
    }
}
