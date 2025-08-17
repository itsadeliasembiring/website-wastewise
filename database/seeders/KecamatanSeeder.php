<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kecamatan')->insert([
            ['id_kecamatan' => 'K001', 'nama_kecamatan' => 'Asemrowo'],
            ['id_kecamatan' => 'K002', 'nama_kecamatan' => 'Benowo'],
            ['id_kecamatan' => 'K003', 'nama_kecamatan' => 'Bubutan'],
            ['id_kecamatan' => 'K004', 'nama_kecamatan' => 'Dukuh Pakis'],
            ['id_kecamatan' => 'K005', 'nama_kecamatan' => 'Gayungan'],
            ['id_kecamatan' => 'K006', 'nama_kecamatan' => 'Genteng'],
            ['id_kecamatan' => 'K007', 'nama_kecamatan' => 'Gubeng'],
            ['id_kecamatan' => 'K008', 'nama_kecamatan' => 'Jambangan'],
            ['id_kecamatan' => 'K009', 'nama_kecamatan' => 'Karang Pilang'],
            ['id_kecamatan' => 'K010', 'nama_kecamatan' => 'Kenjeran'],
            ['id_kecamatan' => 'K011', 'nama_kecamatan' => 'Krembangan'],
            ['id_kecamatan' => 'K012', 'nama_kecamatan' => 'Lakarsantri'],
            ['id_kecamatan' => 'K013', 'nama_kecamatan' => 'Mulyorejo'],
            ['id_kecamatan' => 'K014', 'nama_kecamatan' => 'Pabean Cantikan'],
            ['id_kecamatan' => 'K015', 'nama_kecamatan' => 'Pakal'],
            ['id_kecamatan' => 'K016', 'nama_kecamatan' => 'Rungkut'],
            ['id_kecamatan' => 'K017', 'nama_kecamatan' => 'Sambikerep'],
            ['id_kecamatan' => 'K018', 'nama_kecamatan' => 'Sawahan'],
            ['id_kecamatan' => 'K019', 'nama_kecamatan' => 'Semampir'],
            ['id_kecamatan' => 'K020', 'nama_kecamatan' => 'Simokerto'],
            ['id_kecamatan' => 'K021', 'nama_kecamatan' => 'Sukolilo'],
            ['id_kecamatan' => 'K022', 'nama_kecamatan' => 'Wonokromo'],
            ['id_kecamatan' => 'K023', 'nama_kecamatan' => 'Wiyung'],
            ['id_kecamatan' => 'K024', 'nama_kecamatan' => 'Tambaksari'],
            ['id_kecamatan' => 'K025', 'nama_kecamatan' => 'Tegalsari'],
            ['id_kecamatan' => 'K026', 'nama_kecamatan' => 'Tenggilis Mejoyo'],
            ['id_kecamatan' => 'K027', 'nama_kecamatan' => 'Sukomanunggal'],
            ['id_kecamatan' => 'K028', 'nama_kecamatan' => 'Bulak'],
            ['id_kecamatan' => 'K029', 'nama_kecamatan' => 'Tandes'],
            ['id_kecamatan' => 'K030', 'nama_kecamatan' => 'Gunung Anyar'],
            ['id_kecamatan' => 'K031', 'nama_kecamatan' => 'Surabaya Pusat'],
            ['id_kecamatan' => 'K032', 'nama_kecamatan' => 'Menganti'],
            ['id_kecamatan' => 'K033', 'nama_kecamatan' => 'Kebomas'],
            ['id_kecamatan' => 'K034', 'nama_kecamatan' => 'Manyar'],
            ['id_kecamatan' => 'K035', 'nama_kecamatan' => 'Sidoarjo'],
            ['id_kecamatan' => 'K036', 'nama_kecamatan' => 'Gedangan'],
            ['id_kecamatan' => 'K037', 'nama_kecamatan' => 'Waru'],
            ['id_kecamatan' => 'K038', 'nama_kecamatan' => 'Taman'],
        ]);
    }
}