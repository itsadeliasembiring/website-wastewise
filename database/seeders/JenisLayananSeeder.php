<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisLayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_layanan')->insert([
            [
                'id_jenis_layanan' => 'l1',
                'nama_layanan' => 'Antar Jemput',
            ],
            [
                'id_jenis_layanan' => 'l2',
                'nama_layanan' => 'Setor Langsung',
            ],
        ]);
    }
}
