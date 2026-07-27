<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PelatihanSeeder::class,
            BeritaSeeder::class,
            PendaftaranSeeder::class,
            BuktiPendaftaranSeeder::class,
            JadwalInterviewSeeder::class,
            PenilaianInterviewSeeder::class,
            AbsensiSeeder::class,
            MateriPelatihanSeeder::class,
            PenilaianSeeder::class,
            SertifikatSeeder::class
        ]);
    }
}
