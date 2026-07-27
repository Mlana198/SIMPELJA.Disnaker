<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PelatihanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('pelatihans')->insert([
            [
                // Berdasarkan Surat Undangan Resmi Disnaker Situbondo
                'status_laporan' => 'disetujui',
                'nama_pelatihan' => 'Pelatihan Content Creator',
                'deskripsi'      => 'Pelatihan Content Creator yang diselenggarakan oleh Dinas Ketenagakerjaan Kabupaten Situbondo bertempat di SMKN 1 Panji.',
                'kuota'          => 16,
                'angkatan'       => 1,
                'tanggal_mulai'  => '2025-10-29',
                'tanggal_selesai' => '2025-11-21',
                'status_periode' => 'selesai',
                'foto'           => 'pelatihan/content-creator-angkatan-1.jpg',
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                // Skenario Pelatihan Content Creator Angkatan Berjalan (Aktif)
                'status_laporan' => 'disetujui',
                'nama_pelatihan' => 'Pelatihan Content Creator',
                'deskripsi'      => 'Pelatihan pembuatan konten digital, Copywriting, dan Video Editing tingkat lanjut.',
                'kuota'          => 16,
                'angkatan'       => 2,
                'tanggal_mulai'  => '2026-07-01',
                'tanggal_selesai' => '2026-07-24',
                'status_periode' => 'aktif',
                'foto'           => 'pelatihan/content-creator-angkatan-2.jpg',
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                // Skenario Pengajuan Pelatihan Baru (Draft / Non-Aktif)
                'status_laporan' => 'diajukan',
                'nama_pelatihan' => 'Pelatihan Content Creator',
                'deskripsi'      => 'Program pelatihan intensif bagi kreator pemula dalam mengelola media sosial dan personal branding.',
                'kuota'          => 20,
                'angkatan'       => 3,
                'tanggal_mulai'  => '2026-10-01',
                'tanggal_selesai' => '2026-10-23',
                'status_periode' => 'non-aktif',
                'foto'           => null, // Menguji penanganan nilai NULL pada kolom foto
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
        ]);
    }
}
