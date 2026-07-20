<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Representasi 5 Aktor Utama SIM-PELJA sesuai Aturan Bisnis
        $users = [
            [
                'nomor_identitas' => '198905222015031002', // NIP (18 digit)
                'email' => 'admin@simpelja.go.id',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'profil' => [
                    'nama_lengkap' => 'Rahmat Hidayat, S.Kom.',
                    'no_hp' => '081234567890',
                    'gender' => 'L',
                    'tempat_lahir' => 'Surabaya',
                    'tanggal_lahir' => '1989-05-22',
                    'alamat' => 'Jl. Menanggal No. 12, Surabaya',
                ]
            ],
            [
                'nomor_identitas' => '197611082002121001', // NIP (18 digit)
                'email' => 'subkoor@simpelja.go.id',
                'password' => Hash::make('password123'),
                'role' => 'sub_koordinator',
                'profil' => [
                    'nama_lengkap' => 'Drs. Agus Budiman',
                    'no_hp' => '081234567891',
                    'gender' => 'L',
                    'tempat_lahir' => 'Sidoarjo',
                    'tanggal_lahir' => '1976-11-08',
                    'alamat' => 'Perumahan Delta Sari Blok C-5, Sidoarjo',
                ]
            ],
            [
                'nomor_identitas' => '198203152010012003', // NIP (18 digit)
                'email' => 'instruktur@simpelja.go.id',
                'password' => Hash::make('password123'),
                'role' => 'instruktur',
                'profil' => [
                    'nama_lengkap' => 'Siti Aminah, M.T.',
                    'no_hp' => '081234567892',
                    'gender' => 'P',
                    'tempat_lahir' => 'Malang',
                    'tanggal_lahir' => '1982-03-15',
                    'alamat' => 'Jl. Candi Panggung No. 45, Malang',
                ]
            ],
            [
                'nomor_identitas' => '197001011996031001', // NIP (18 digit)
                'email' => 'kabid@simpelja.go.id',
                'password' => Hash::make('password123'),
                'role' => 'kabid',
                'profil' => [
                    'nama_lengkap' => 'Ir. Heru Prasetyo, M.M.',
                    'no_hp' => '081234567893',
                    'gender' => 'L',
                    'tempat_lahir' => 'Gresik',
                    'tanggal_lahir' => '1970-01-01',
                    'alamat' => 'Jl. Raya Darmo No. 100, Surabaya',
                ]
            ],
            [
                'nomor_identitas' => '3515061203990002', // NIK (16 digit)
                'email' => 'budi.peserta@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'peserta',
                'profil' => [
                    'nama_lengkap' => 'Budi Setiawan',
                    'no_hp' => '085712345678',
                    'gender' => 'L',
                    'tempat_lahir' => 'Sidoarjo',
                    'tanggal_lahir' => '1999-03-12',
                    'alamat' => 'Desa Wage RT 04 RW 02, Taman, Sidoarjo',
                ]
            ],
        ];

        // Memanfaatkan Database Transaction untuk menjaga konsistensi relasi parent-child
        DB::transaction(function () use ($users) {
            foreach ($users as $user) {
                // Insert data login ke tabel users
                $userId = DB::table('users')->insertGetId([
                    'nomor_identitas' => $user['nomor_identitas'],
                    'email' => $user['email'],
                    'password' => $user['password'],
                    'role' => $user['role'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Insert data profil ke tabel profil_pengguna terikat dengan user_id 
                DB::table('profil_pengguna')->insert([
                    'user_id' => $userId,
                    'nama_lengkap' => $user['profil']['nama_lengkap'],
                    'no_hp' => $user['profil']['no_hp'],
                    'gender' => $user['profil']['gender'],
                    'tempat_lahir' => $user['profil']['tempat_lahir'],
                    'tanggal_lahir' => $user['profil']['tanggal_lahir'],
                    'alamat' => $user['profil']['alamat'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        });
    }
}
