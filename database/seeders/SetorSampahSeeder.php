<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SetorSampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('setor_sampah')->insert([
            'id_setor' => 'S00001',
            'waktu_setor' => now(),
            'total_berat' => 15.5,
            'total_poin' => 100,
            'lokasi_penjemputan' => 'Jl. Merdeka No. 10',
            'waktu_penjemputan' => '14:00:00',
            'kode_verifikasi' => 'VER1234',
            'status_verifikasi' => true,
            'status_setor' => 'Selesai',
            'metode_setor' => 'Dijemput',
            'catatan' => 'Penjemputan berhasil dilakukan',
            'id_bank_sampah' => 'B01',
            'id_pengguna' => 'PG0001',
        ]);

        DB::table('setor_sampah')->insert([
            'id_setor' => 'S00002',
            'waktu_setor' => now(),
            'total_berat' => 10.0,
            'total_poin' => 80,
            'lokasi_penjemputan' => 'Jl. Raya No. 5',
            'waktu_penjemputan' => '09:00:00',
            'kode_verifikasi' => 'VER5678',
            'status_verifikasi' => false,
            'status_setor' => 'Pending',
            'metode_setor' => 'Setor Langsung',
            'catatan' => 'Sedang dalam proses verifikasi',
            'id_bank_sampah' => 'B02',
            'id_pengguna' => 'PG0002',
        ]);
    }
}
