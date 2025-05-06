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
                'jenis_kelamin'  => false, // false = perempuan
                'tanggal_lahir'  => '2001-03-12',
                'nomor_telepon'  => '081234567891',
                'total_poin'     => 120,
                'foto'           => null,
                'detail_alamat'  => 'Jl. Melati No. 5, Bekasi',
                'id_akun'        => 'u0001',
                'id_kelurahan'   => 'L001',
            ],
            [
                'id_pengguna'    => 'PG0002',
                'nama_lengkap'   => 'Satria Pratama',
                'jenis_kelamin'  => true, // true = laki-laki
                'tanggal_lahir'  => '1999-07-22',
                'nomor_telepon'  => '081298765431',
                'total_poin'     => 200,
                'foto'           => 'satria.jpg',
                'detail_alamat'  => 'Jl. Kenanga No. 7, Surabaya',
                'id_akun'        => 'u0002',
                'id_kelurahan'   => 'L002',
            ],
            [
                'id_pengguna'    => 'PG0003',
                'nama_lengkap'   => 'Adelina Putri',
                'jenis_kelamin'  => false,
                'tanggal_lahir'  => '2002-10-15',
                'nomor_telepon'  => '081234000000',
                'total_poin'     => 180,
                'foto'           => 'adelina.jpg',
                'detail_alamat'  => 'Jl. Dahlia No. 9, Surabaya',
                'id_akun'        => 'u0025',
                'id_kelurahan'   => 'L003',
            ]
        ]);
    }
}
