<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenukaranDonasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penukaran_donasi')->insert([
            [
                'id_penukaran_donasi' => 'D001',
                'waktu' => Carbon::now()->subDays(7),
                'jumlah_poin' => 150,
                'id_donasi' => 'D01',       // Sesuai dengan DonasiSeeder
                'id_pengguna' => 'PG0001',  // Sesuai dengan PenggunaSeeder
            ],
            [
                'id_penukaran_donasi' => 'D002',
                'waktu' => Carbon::now()->subDays(4),
                'jumlah_poin' => 200,
                'id_donasi' => 'D02',
                'id_pengguna' => 'PG0002',
            ],
            [
                'id_penukaran_donasi' => 'D003',
                'waktu' => Carbon::now()->subDay(),
                'jumlah_poin' => 120,
                'id_donasi' => 'D01',
                'id_pengguna' => 'PG0003',
            ],
        ]);
    }
}
