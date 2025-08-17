<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PenukaranBarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penukaran_barang')->insert([
            [
                'id_penukaran_barang' => 'P001',
                'waktu' => Carbon::now()->subDays(5),
                'jumlah_poin' => 100,
                'kode_redeem' => 'KODE12345',
                'id_barang' => 'B01',
                'id_pengguna' => 'PG0001',
            ],
            [
                'id_penukaran_barang' => 'P002',
                'waktu' => Carbon::now()->subDays(3),
                'jumlah_poin' => 80,
                'kode_redeem' => 'KODE23456',
                'id_barang' => 'B02',
                'id_pengguna' => 'PG0001',
            ],
            [
                'id_penukaran_barang' => 'P003',
                'waktu' => Carbon::now()->subDay(),
                'jumlah_poin' => 50,
                'kode_redeem' => 'KODE34567',
                'id_barang' => 'B03',
                'id_pengguna' => 'PG0001',
            ],
        ]);
    }
}
