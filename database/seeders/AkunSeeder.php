<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("akun")->insert([
            "id_akun" => "U0001",
            "id_level" => "1",
            
            "email" => "admin@wastewise.com",
            "password" => bcrypt("12345"),
        ]);

      
        DB::table("akun")->insert([
            "id_akun" => "U0002",
            "id_level" => "3",
            
            "email" => "pengguna@wastewise.com",
            "password" => bcrypt("12345"),
        ]);
    }
}
