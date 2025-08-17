<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('barang')->insert([
            [
                'id_barang' => 'B01',
                'nama_barang' => 'Tumbler Stainless',
                'deskripsi_barang' => 'Tumbler ramah lingkungan berkapasitas 500ml',
                'stok' => 10,
                'bobot_poin' => 150,
                'foto' => '1750059558_botol stainless.jpeg',
            ],
            [
                'id_barang' => 'B02',
                'nama_barang' => 'Totebag Kain',
                'deskripsi_barang' => 'Totebag berbahan kanvas',
                'stok' => 25,
                'bobot_poin' => 80,
                'foto' => 'totebag kain.jpeg',
            ],
            [
                'id_barang' => 'B03',
                'nama_barang' => 'Pulpen Daur Ulang',
                'deskripsi_barang' => 'Pulpen dari bahan daur ulang',
                'stok' => 50,
                'bobot_poin' => 20,
                'foto' => 'pulpen daur ulang.jpeg',
            ],
        ]);
    }
}
