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
            'detail_ciri' => 'Bersifat lentur atau kaku, ringan, tahan air, dan mudah terbakar. Biasanya berwarna bening, putih, atau hitam.',
            'detail_manfaat' => 'Dapat didaur ulang menjadi produk baru seperti tas, ember, pot bunga, dan peralatan rumah tangga lainnya.',
            'bobot_poin' => 5,
            'foto' => 'plastik.png',
            'jenis_sampah' => 'J01',
        ]);

        DB::table("sampah")->insert([
            'id_sampah' => 'S02',
            'nama_sampah' => 'Kaleng (Logam)',
            'detail_ciri' => 'Terbuat dari logam ringan seperti aluminium atau besi, sering digunakan sebagai wadah makanan atau minuman.',
            'detail_manfaat' => 'Dapat dilebur dan digunakan kembali untuk membuat produk logam baru seperti paku, besi cor, atau komponen mesin.',
            'bobot_poin' => 10,
            'foto' => 'kaleng.png',
            'jenis_sampah' => 'J03',
        ]);

        DB::table("sampah")->insert([
            'id_sampah' => 'S03',
            'nama_sampah' => 'Botol Kaca',
            'detail_ciri' => 'Berbahan kaca, keras dan mudah pecah, biasanya bening atau berwarna hijau/coklat. Umumnya berasal dari botol minuman.',
            'detail_manfaat' => 'Dapat dilebur ulang menjadi botol kaca baru atau bahan baku produk kaca lainnya seperti ubin dan dekorasi.',
            'bobot_poin' => 15,
            'foto' => 'kaca.png',
            'jenis_sampah' => 'J01',
        ]);

        DB::table("sampah")->insert([
            'id_sampah' => 'S04',
            'nama_sampah' => 'Kardus',
            'detail_ciri' => 'Bersifat ringan dan tebal, terbuat dari kertas berlapis. Umumnya digunakan sebagai kemasan barang atau makanan.',
            'detail_manfaat' => 'Dapat didaur ulang menjadi kertas daur ulang, kemasan baru, atau bahan dasar kerajinan tangan.',
            'bobot_poin' => 7,
            'foto' => 'kardus.png',
            'jenis_sampah' => 'J02',
        ]);

        DB::table("sampah")->insert([
            'id_sampah' => 'S05',
            'nama_sampah' => 'Minyak',
            'detail_ciri' => 'Berbentuk cair dan lengket, biasanya berwarna kuning kecoklatan atau hitam. Merupakan limbah dari minyak goreng bekas.',
            'detail_manfaat' => 'Dapat diolah menjadi biodiesel atau bahan bakar alternatif, serta digunakan untuk pelumas industri setelah proses pemurnian.',
            'bobot_poin' => 20,
            'foto' => 'minyak.png',
            'jenis_sampah' => 'J03',
        ]);
    }
}
