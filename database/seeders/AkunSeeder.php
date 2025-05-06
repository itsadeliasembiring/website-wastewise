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
            
            "email" => "adinda@gmail.com",
            "password" => bcrypt("12345"),
        ]);

        DB::table("akun")->insert([
            "id_akun" => "U0002",
            "id_level" => "2",
            
            "email" => "satria@gmail.com",
            "password" => bcrypt("12345"),

        ]);
        
        DB::table("akun")->insert([
            "id_akun" => "U0003",
            "id_level" => "3",
            
            "email" => "pao@gmail.com",
            "password" => bcrypt("12345"),
        ]);

        DB::table("akun")->insert([
            "id_akun" => "U0004",
            "id_level" => "3",
            
            "email" => "agus@gmail.com",
            "password" => bcrypt("12345"),
        ]);

        DB::table("akun")->insert([
            "id_akun" => "U0005",
            "id_level" => "3",
            
            "email" => "dela@gmail.com",
            "password" => bcrypt("12345"),
        ]);

        DB::table("akun")->insert([
            "id_akun" => "U0006",
            "id_level" => "3",
            
            "email" => "indah@gmail.com",
            "password" => bcrypt("12345"),
        ]);

        DB::table("akun")->insert([
            "id_akun" => "U0007",
            "id_level" => "3",
            
            "email" => "meilya@gmail.com",
            "password" => bcrypt("12345"),
        ]);
        
        DB::table("akun")->insert([
            "id_akun" => "U0008",
            "id_level" => "3",
            
            "email" => "titi@gmail.com",
            "password" => bcrypt("12345"),
        ]);

        DB::table("akun")->insert([
            "id_akun" => "U0009",
            "id_level" => "3",
            
            "email" => "natalia@gmail.com",
            "password" => bcrypt("12345"),
        ]);

        DB::table("akun")->insert([
            "id_akun" => "U0010",
            "id_level" => "2",
            
            "email" => "dani@gmail.com",
            "password" => bcrypt("12345"),
        ]);

        DB::table("akun")->insert([
            "id_akun" => "U0025",
            "id_level" => "3",
            
            "email" => "adel@gmail.com",
            "password" => bcrypt("12345"),
        ]);
    }
}
