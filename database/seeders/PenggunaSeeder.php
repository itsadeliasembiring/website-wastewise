<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pengguna')->insert([
            [
                'id_pengguna'    => 'PG0001',
                'nama_lengkap'   => 'Adinda Larasati',
                'jenis_kelamin'  =>  'Perempuan', 
                'tanggal_lahir'  => '2001-03-12',
                'nomor_telepon'  => '081234567891',
                'total_poin'     => 120,
                'foto'           => null,
                'detail_alamat'  => 'Jl. Melati No. 5, Bekasi',
                'id_akun'        => 'U0002',
                'id_kelurahan'   => 'L001',
            ],
        ]);
    }
}
