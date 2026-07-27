<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            // ==========================================
            // 1. AKTOR UTAMA / OPERATOR & PEJABAT
            // ==========================================
            [
                'nomor_identitas' => '200003122025212045',
                'email' => 'wiji.wulandari@simpelja.go.id',
                'password' => Hash::make('password123'),
                'role' => 'admin', // Operator Ayo Bekerja
                'profil' => [
                    'nama_lengkap' => 'Wiji Wulandari, S.M',
                    'no_hp' => '081234567801',
                    'gender' => 'P',
                    'tempat_lahir' => 'Situbondo',
                    'tanggal_lahir' => '2000-03-12',
                    'alamat' => 'Situbondo',
                ]
            ],
            [
                'nomor_identitas' => '198212271998031012',
                'email' => 'prima.devi@simpelja.go.id',
                'password' => Hash::make('password123'),
                'role' => 'sub_koordinator', // Sub Koordinator Pelatihan / Kasi. Transmigrasi
                'profil' => [
                    'nama_lengkap' => 'Prima Devi Raditya Putra, S.P',
                    'no_hp' => '081234567802',
                    'gender' => 'L',
                    'tempat_lahir' => 'Situbondo',
                    'tanggal_lahir' => '1982-12-27',
                    'alamat' => 'Situbondo',
                ]
            ],
            [
                'nomor_identitas' => '196904171992032007',
                'email' => 'danik.sumartini@simpelja.go.id',
                'password' => Hash::make('password123'),
                'role' => 'kabid', // Kepala Bidang Latas
                'profil' => [
                    'nama_lengkap' => 'Danik Sumartini, S.Sos. M.Si',
                    'no_hp' => '081234567803',
                    'gender' => 'P',
                    'tempat_lahir' => 'Situbondo',
                    'tanggal_lahir' => '1969-04-17',
                    'alamat' => 'Situbondo',
                ]
            ],
            [
                'nomor_identitas' => '199001012024012001', // Dummy NIP jika Non-ASN/Instruktur
                'email' => 'ameita.rosaliya@simpelja.go.id',
                'password' => Hash::make('password123'),
                'role' => 'instruktur', // Instruktur Pelatihan Content Creator
                'profil' => [
                    'nama_lengkap' => 'Ameita Rosaliya',
                    'no_hp' => '081234567804',
                    'gender' => 'P',
                    'tempat_lahir' => 'Situbondo',
                    'tanggal_lahir' => '1990-01-01',
                    'alamat' => 'Situbondo',
                ]
            ],

            // ==========================================
            // 2. DAFTAR PESERTA PELATIHAN CONTENT CREATOR
            // ==========================================
            [
                'nomor_identitas' => '3512060404030001',
                'email' => 'achmad.ali@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'peserta',
                'profil' => [
                    'nama_lengkap' => 'ACHMAD ALI RIDHA',
                    'no_hp' => '085200000001',
                    'gender' => 'L',
                    'tempat_lahir' => 'SITUBONDO',
                    'tanggal_lahir' => '2003-04-04',
                    'alamat' => 'SITUBONDO',
                ]
            ],
            [
                'nomor_identitas' => '3512092007990002',
                'email' => 'badris.syamsi@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'peserta',
                'profil' => [
                    'nama_lengkap' => 'BADRIS SYAMSI',
                    'no_hp' => '085200000002',
                    'gender' => 'L',
                    'tempat_lahir' => 'SITUBONDO',
                    'tanggal_lahir' => '1999-07-20',
                    'alamat' => 'SITUBONDO',
                ]
            ],
            [
                'nomor_identitas' => '3512112207990001',
                'email' => 'bima.sakti@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'peserta',
                'profil' => [
                    'nama_lengkap' => 'BIMA SAKTI',
                    'no_hp' => '085200000003',
                    'gender' => 'L',
                    'tempat_lahir' => 'SITUBONDO',
                    'tanggal_lahir' => '1999-07-22',
                    'alamat' => 'SITUBONDO',
                ]
            ],
            [
                'nomor_identitas' => '3512095412990001',
                'email' => 'deviana.purnama@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'peserta',
                'profil' => [
                    'nama_lengkap' => 'DEVIANA PURNAMA SARI',
                    'no_hp' => '085200000004',
                    'gender' => 'P',
                    'tempat_lahir' => 'SITUBONDO',
                    'tanggal_lahir' => '1999-12-14',
                    'alamat' => 'SITUBONDO',
                ]
            ],
            [
                'nomor_identitas' => '3512111607040002',
                'email' => 'eka.jumantoro@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'peserta',
                'profil' => [
                    'nama_lengkap' => 'EKA JUMANTORO',
                    'no_hp' => '085200000005',
                    'gender' => 'L',
                    'tempat_lahir' => 'SITUBONDO',
                    'tanggal_lahir' => '2004-07-16',
                    'alamat' => 'SITUBONDO',
                ]
            ],
            [
                'nomor_identitas' => '3512025812940001',
                'email' => 'intan.aksanul@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'peserta',
                'profil' => [
                    'nama_lengkap' => 'INTAN AKSANUL',
                    'no_hp' => '085200000006',
                    'gender' => 'P',
                    'tempat_lahir' => 'BATU',
                    'tanggal_lahir' => '1994-12-18',
                    'alamat' => 'BATU',
                ]
            ],
            [
                'nomor_identitas' => '3512056912950002',
                'email' => 'liza.diana@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'peserta',
                'profil' => [
                    'nama_lengkap' => 'LIZA DIANA MANZIEL',
                    'no_hp' => '085200000007',
                    'gender' => 'P',
                    'tempat_lahir' => 'SITUBONDO',
                    'tanggal_lahir' => '1995-12-29',
                    'alamat' => 'SITUBONDO',
                ]
            ],
            [
                'nomor_identitas' => '3512041308010004',
                'email' => 'rifqi.abdul@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'peserta',
                'profil' => [
                    'nama_lengkap' => 'M. RIFQI ABDUL HAMID',
                    'no_hp' => '085200000008',
                    'gender' => 'L',
                    'tempat_lahir' => 'SITUBONDO',
                    'tanggal_lahir' => '2001-08-13',
                    'alamat' => 'SITUBONDO',
                ]
            ],
            [
                'nomor_identitas' => '3512022302020001',
                'email' => 'ilham.fathoni@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'peserta',
                'profil' => [
                    'nama_lengkap' => 'MUHAMMAD ILHAM FATHONI',
                    'no_hp' => '085200000009',
                    'gender' => 'L',
                    'tempat_lahir' => 'SITUBONDO',
                    'tanggal_lahir' => '2002-02-23',
                    'alamat' => 'SITUBONDO',
                ]
            ],
            [
                'nomor_identitas' => '3512081502040001',
                'email' => 'nur.febriansyah@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'peserta',
                'profil' => [
                    'nama_lengkap' => 'MUHAMMAD NUR FEBRIANSYAH',
                    'no_hp' => '085200000010',
                    'gender' => 'L',
                    'tempat_lahir' => 'SITUBONDO',
                    'tanggal_lahir' => '2004-02-15',
                    'alamat' => 'SITUBONDO',
                ]
            ],
            [
                'nomor_identitas' => '3512136011010001',
                'email' => 'novia.bella@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'peserta',
                'profil' => [
                    'nama_lengkap' => 'NOVIA BELLA',
                    'no_hp' => '085200000011',
                    'gender' => 'P',
                    'tempat_lahir' => 'SITUBONDO',
                    'tanggal_lahir' => '2001-11-20',
                    'alamat' => 'SITUBONDO',
                ]
            ],
            [
                'nomor_identitas' => '3512074905830004',
                'email' => 'nur.amalia@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'peserta',
                'profil' => [
                    'nama_lengkap' => 'NUR AMALIA, SE.',
                    'no_hp' => '085200000012',
                    'gender' => 'P',
                    'tempat_lahir' => 'SITUBONDO',
                    'tanggal_lahir' => '1983-05-09',
                    'alamat' => 'SITUBONDO',
                ]
            ],
            [
                'nomor_identitas' => '3508176809930002',
                'email' => 'septika.dwi@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'peserta',
                'profil' => [
                    'nama_lengkap' => 'SEPTIKA DWI MAULINA',
                    'no_hp' => '085200000013',
                    'gender' => 'P',
                    'tempat_lahir' => 'SITUBONDO',
                    'tanggal_lahir' => '1993-09-28',
                    'alamat' => 'SITUBONDO',
                ]
            ],
            [
                'nomor_identitas' => '3512072006960001',
                'email' => 'taufiqqurahman@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'peserta',
                'profil' => [
                    'nama_lengkap' => 'TAUFIQQURAHMAN',
                    'no_hp' => '085200000014',
                    'gender' => 'L',
                    'tempat_lahir' => 'SITUBONDO',
                    'tanggal_lahir' => '1996-06-20',
                    'alamat' => 'SITUBONDO',
                ]
            ],
            [
                'nomor_identitas' => '3512084605000003',
                'email' => 'tiara.dwi@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'peserta',
                'profil' => [
                    'nama_lengkap' => 'TIARA DWI MEILINDA AISA',
                    'no_hp' => '085200000015',
                    'gender' => 'P',
                    'tempat_lahir' => 'SITUBONDO',
                    'tanggal_lahir' => '2000-05-06',
                    'alamat' => 'SITUBONDO',
                ]
            ],
            [
                'nomor_identitas' => '3512134907990001',
                'email' => 'wahyu.saraswati@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'peserta',
                'profil' => [
                    'nama_lengkap' => 'WAHYU SARASWATI',
                    'no_hp' => '085200000016',
                    'gender' => 'P',
                    'tempat_lahir' => 'SITUBONDO',
                    'tanggal_lahir' => '1999-07-09',
                    'alamat' => 'SITUBONDO',
                ]
            ],
        ];

        DB::transaction(function () use ($users) {
            foreach ($users as $user) {
                $userId = DB::table('users')->insertGetId([
                    'nomor_identitas' => $user['nomor_identitas'],
                    'email' => $user['email'],
                    'password' => $user['password'],
                    'role' => $user['role'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

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
