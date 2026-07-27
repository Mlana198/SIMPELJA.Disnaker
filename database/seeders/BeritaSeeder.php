<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('beritas')->insert([
            [
                // Berita 1: Pelatihan Content Creator Angkatan 1 (2025)
                'judul'           => 'Disnaker Situbondo Buka Pelatihan Content Creator Angkatan I di SMKN 1 Panji',
                'konten'          => 'Dinas Ketenagakerjaan (Disnaker) Kabupaten Situbondo resmi membuka Pelatihan Content Creator TA 2025 pada Rabu (29/10/2025). Sebanyak 16 peserta yang terpilih akan mengikuti pelatihan intensif selama 22 hari bertempat di SMKN 1 Panji Situbondo. Program ini bertujuan untuk membekali tenaga kerja muda dengan keterampilan digital di bidang pembuatan konten dan branding.',
                'foto_banner'     => 'berita/pembukaan-pelatihan-content-creator-2025.jpg',
                'tanggal_publish' => '2025-10-29 08:00:00',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                // Berita 2: Pelatihan Content Creator Angkatan 2 (2026)
                'judul'           => 'Tingkatkan Daya Saing Digital, Pelatihan Content Creator Angkatan II Resmi Dimulai',
                'konten'          => 'Memasuki pertengahan tahun 2026, Pelatihan Content Creator Angkatan II kembali digelar dengan fokus pada optimalisasi media sosial, strategi copywriting, serta teknik pengambilan video profesional. Kegiatan ini diikuti oleh 16 peserta terdaftar yang siap mengasah keahlian kreatif untuk mendukung sektor perekonomian digital lokal.',
                'foto_banner'     => 'berita/pelatihan-content-creator-angkatan-2.jpg',
                'tanggal_publish' => '2026-07-01 09:30:00',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
            [
                // Berita 3: Pelatihan Content Creator Angkatan 3 (2026)
                'judul'           => 'Persiapan Pelatihan Content Creator Angkatan III: Pembukaan Pendaftaran Segera Dibuka',
                'konten'          => 'Melihat tingginya antusiasme masyarakat, pengajuan Pelatihan Content Creator Angkatan III kini sedang diproses. Pelatihan ini dirancang untuk memfasilitasi 20 peserta pemula yang ingin mempelajari personal branding dan pengelolaan media sosial. Informasi mengenai tanggal pelaksanaan dan tahapan seleksi akan diumumkan dalam waktu dekat.',
                'foto_banner'     => null, // Menguji penanganan nullable banner
                'tanggal_publish' => '2026-07-25 10:00:00',
                'created_at'      => $now,
                'updated_at'      => $now,
            ],
        ]);
    }
}
