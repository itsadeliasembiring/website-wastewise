<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelAkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //input database
        DB::table("level_akun")->insert([
            "id_level" => "1",
            "nama_level" => "Admin",
        ]);
        DB::table("level_akun")->insert([
            "id_level" => "2",
            "nama_level" => "Bank Sampah",
        ]);

        DB::table("level_akun")->insert([
            "id_level" => "3",
            "nama_level" => "Pengguna",
        ]);
    }
}
