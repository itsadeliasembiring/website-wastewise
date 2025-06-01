<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("sampah")->insert([
            'id_sampah' => 'S01',
            'nama_sampah' => 'Plastik',
            'detail_ciri' => 'Sampah jenis plastik, berwarna bening atau hitam, mudah terbakar.',
            'detail_manfaat' => 'Dapat didaur ulang menjadi produk baru seperti tas, kotak, dll.',
            'bobot_poin' => 5,
            'foto' => 'plastik.jpg',
            'jenis_sampah' => 'J01', // Matches with 'id_jenis_sampah' in jenis_sampah
        ]);

        DB::table("sampah")->insert([
            'id_sampah' => 'S02',
            'nama_sampah' => 'Kertas',
            'detail_ciri' => 'Sampah jenis kertas, bisa berupa koran, majalah, atau buku bekas.',
            'detail_manfaat' => 'Dapat didaur ulang menjadi kertas baru atau produk kerajinan.',
            'bobot_poin' => 3,
            'foto' => 'kertas.jpg',
            'jenis_sampah' => 'J02', // Matches with 'id_jenis_sampah' in jenis_sampah
        ]);

        DB::table("sampah")->insert([
            'id_sampah' => 'S03',
            'nama_sampah' => 'Logam',
            'detail_ciri' => 'Sampah jenis logam, seperti kaleng minuman atau logam bekas lainnya.',
            'detail_manfaat' => 'Dapat didaur ulang untuk digunakan kembali sebagai bahan logam baru.',
            'bobot_poin' => 10,
            'foto' => 'logam.jpg',
            'jenis_sampah' => 'J03', // Matches with 'id_jenis_sampah' in jenis_sampah
        ]);

        DB::table("sampah")->insert([
            'id_sampah' => 'S04',
            'nama_sampah' => 'Botol Kaca',
            'detail_ciri' => 'Botol kaca bekas minuman atau produk lainnya, berwarna bening atau gelap.',
            'detail_manfaat' => 'Dapat didaur ulang menjadi botol kaca baru atau produk kaca lainnya.',
            'bobot_poin' => 15,
            'foto' => 'botol_kaca.jpg',
            'jenis_sampah' => 'J01', // Matches with 'id_jenis_sampah' in jenis_sampah
        ]);

        DB::table("sampah")->insert([
            'id_sampah' => 'S05',
            'nama_sampah' => 'Kardus',
            'detail_ciri' => 'Kardus bekas, biasanya digunakan untuk kemasan barang.',
            'detail_manfaat' => 'Dapat didaur ulang untuk digunakan sebagai bahan kardus baru.',
            'bobot_poin' => 7,
            'foto' => 'kardus.jpg',
            'jenis_sampah' => 'J02', // Matches with 'id_jenis_sampah' in jenis_sampah
        ]);

        DB::table("sampah")->insert([
            'id_sampah' => 'S06',
            'nama_sampah' => 'Elektronik',
            'detail_ciri' => 'Barang elektronik rusak atau bekas, seperti televisi, radio, dan alat elektronik lainnya.',
            'detail_manfaat' => 'Dapat didaur ulang untuk mengambil bahan berharga seperti logam dan plastik.',
            'bobot_poin' => 20,
            'foto' => 'elektronik.jpg',
            'jenis_sampah' => 'J03', // Matches with 'id_jenis_sampah' in jenis_sampah
        ]);
    }
}