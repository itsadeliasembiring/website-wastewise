<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RiwayatPoinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('riwayat_poin')->insert([
            [
                'id_riwayat'       => 'R0001',
                'waktu'            => now()->subDays(5),
                'jenis_perubahan'  => 'penambahan',
                'jumlah_poin'      => 50,
                'id_pengguna'      => 'PG0001',
        ],
            [
                'id_riwayat'       => 'R0002',
                'waktu'            => now()->subDays(3),
                'jenis_perubahan'  => 'pengurangan',
                'jumlah_poin'      => 20,
                'id_pengguna'      => 'PG0002',
        ],
            [
                'id_riwayat'       => 'R0003',
                'waktu'            => now()->subDays(1),
                'jenis_perubahan'  => 'penambahan',
                'jumlah_poin'      => 30,
                'id_pengguna'      => 'PG0001',
        ],
            [
                'id_riwayat'       => 'R0004',
                'waktu'            => now(),
                'jenis_perubahan'  => 'penambahan',
                'jumlah_poin'      => 100,
                'id_pengguna'      => 'PG0003',
            ],
        ]);
    }
}
