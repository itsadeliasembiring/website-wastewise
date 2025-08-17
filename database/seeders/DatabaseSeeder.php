<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Contoh pembersihan data dulu (opsional)
        User::where('email', 'test@example.com')->delete();

        // Buat 1 user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Panggil semua seeder lainnya
        $this->call([
            LevelAkunSeeder::class,
            AkunSeeder::class,
            JenisLayananSeeder::class,
            JenisSampahSeeder::class,
            KecamatanSeeder::class,
            KelurahanSeeder::class,
            PenggunaSeeder::class,
            DonasiSeeder::class,
            RiwayatPoinSeeder::class,
            BarangSeeder::class,
            PenukaranBarangSeeder::class,
            PenukaranDonasiSeeder::class,
            BankSampahSeeder::class,
            SampahSeeder::class,
            ArtikelSeeder::class,
            SetorSampahSeeder::class,
            DetailSetorSampahSeeder::class,
        ]);
    }
}
