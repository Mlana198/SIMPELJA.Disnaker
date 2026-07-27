<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenilaianInterviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $jadwalInterviews = DB::table('jadwal_interview')->orderBy('id', 'asc')->get();

        if ($jadwalInterviews->isEmpty()) {
            $this->command->warn('Seeder PenilaianInterview dilewati: Tidak ditemukan data pada tabel jadwal_interview.');
            return;
        }

        $penilaians = [];

        $catatanLulus = [
            'Komunikasi sangat baik, memiliki portofolio dasar yang solid.',
            'Motivasi belajar tinggi dan sangat berkomitmen mengikuti pelatihan hingga selesai.',
            'Kemampuan analisis cukup baik, memiliki ide kreatif yang aplikatif.',
            'Sangat menguasai dasar-dasar bidang yang dilamar.'
        ];

        $catatanCadangan = [
            'Memenuhi kualifikasi dasar namun pemahaman teknis masih perlu ditingkatkan.',
            'Sikap dan komunikasi baik, namun pengalaman praktis masih sangat terbatas.',
            'Kapasitas kelas penuh, direkomendasikan sebagai peserta cadangan.'
        ];

        $catatanGagal = [
            'Kurang menunjukkan komitmen waktu untuk mengikuti pelatihan secara intensif.',
            'Pengetahuan dasar sangat kurang dan tidak memenuhi kriteria minimal.'
        ];

        foreach ($jadwalInterviews as $index => $jadwal) {
            if ($index < 16) {
                $statusAkhir = 'Lulus';
                $statusPengajuan = 'Disetujui Kabid';
                $skorMinat = rand(80, 95);
                $skorBakat = rand(85, 98);
                $catatan = $catatanLulus[array_rand($catatanLulus)];
            } elseif ($index < 19) {
                $statusAkhir = 'Cadangan';
                $statusPengajuan = 'Diajukan Subkoor';
                $skorMinat = rand(65, 79);
                $skorBakat = rand(70, 80);
                $catatan = $catatanCadangan[array_rand($catatanCadangan)];
            } else {
                $statusAkhir = 'Gagal';
                $statusPengajuan = 'Draft';
                $skorMinat = rand(40, 64);
                $skorBakat = rand(45, 60);
                $catatan = $catatanGagal[array_rand($catatanGagal)];
            }

            $penilaians[] = [
                'jadwal_interview_id' => $jadwal->id,
                'skor_minat'          => $skorMinat,
                'skor_bakat'          => $skorBakat,
                'catatan_kualitatif'  => $catatan,
                'status_akhir'        => $statusAkhir,
                'status_pengajuan'    => $statusPengajuan,
                'created_at'          => $now,
                'updated_at'          => $now,
            ];
        }

        DB::table('penilaian_interviews')->insert($penilaians);
    }
}
