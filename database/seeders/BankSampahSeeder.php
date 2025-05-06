<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BankSampahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("bank_sampah")->insert([
            "id_bank_sampah" => "B01",
            "nama_bank_sampah" => "Bank Sampah Hijau",
            "tanggal_berdiri" => "2020-05-10",
            "nomor_telepon" => "081234567890",
            "surat_legalitas" => "legalitas_hijau.pdf",
            "foto" => "foto_hijau.jpg",
            "detail_alamat" => "Jl. Melati No.10, Surabaya",
            "id_kelurahan" => "L001",
            "kontak" => "081234567890",
            "id_akun" => "u0002" // Sesuai dengan data di AkunSeeder
        ]);

        DB::table("bank_sampah")->insert([
            "id_bank_sampah" => "B02",
            "nama_bank_sampah" => "Bank Sampah Bersih",
            "tanggal_berdiri" => "2019-08-15",
            "nomor_telepon" => "082233445566",
            "surat_legalitas" => "legalitas_bersih.pdf",
            "foto" => "foto_bersih.jpg",
            "detail_alamat" => "Jl. Kenanga No.12, Surabaya",
            "id_kelurahan" => "L002",
            "kontak" => "082233445566",
            "id_akun" => "u0010" // Sesuai dengan data di AkunSeeder
        ]);
    }
}
