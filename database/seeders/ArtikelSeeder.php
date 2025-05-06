<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtikelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('artikel')->insert([
            'id_artikel' => 'A0001',
            'judul_artikel' => 'Pentingnya Pengelolaan Sampah di Kota',
            'waktu_publikasi' => now(),
            'detail_artikel' => 'Artikel ini membahas tentang bagaimana pentingnya pengelolaan sampah di kota besar...',
            'foto' => 'artikel1.jpg',
            'penulis_artikel' => 'B01', // diubah dari u0001 ke B01
        ]);
        
        DB::table('artikel')->insert([
            'id_artikel' => 'A0002',
            'judul_artikel' => 'Inovasi Teknologi dalam Daur Ulang Sampah',
            'waktu_publikasi' => now(),
            'detail_artikel' => 'Teknologi terbaru dalam mengolah sampah plastik menjadi bahan yang berguna...',
            'foto' => 'artikel2.jpg',
            'penulis_artikel' => 'B02', // diubah dari u0002 ke B02
        ]);
        // Tambah artikel lainnya sesuai kebutuhan
    }
}
