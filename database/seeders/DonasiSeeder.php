<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DonasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('donasi')->insert([
            [
                'id_donasi'       => 'D01',
                'nama_donasi'     => 'Donasi Bencana Alam',
                'deskripsi_donasi'=> 'Bantuan untuk korban bencana alam di daerah terdampak.',
                'total_donasi'    => 0,
                'foto'            => 'bencana_alam.jpg',
            ],
            [
                'id_donasi'       => 'D02',
                'nama_donasi'     => 'Donasi Pendidikan Anak',
                'deskripsi_donasi'=> 'Membantu anak-anak kurang mampu mendapatkan pendidikan yang layak.',
                'total_donasi'    => 0,
                'foto'            => 'pendidikan_anak.jpg',
            ],
            [
                'id_donasi'       => 'D03',
                'nama_donasi'     => 'Donasi Kesehatan',
                'deskripsi_donasi'=> 'Penggalangan dana untuk pengobatan masyarakat tidak mampu.',
                'total_donasi'    => 0,
                'foto'            => 'donasi_kesehatan.jpg',
            ]
        ]);
    }
}
