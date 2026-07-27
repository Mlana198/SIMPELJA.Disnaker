<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class JadwalInterviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $pendaftarans = DB::table('pendaftaran')->orderBy('id', 'asc')->get();

        if ($pendaftarans->isEmpty()) {
            $this->command->warn('Seeder JadwalInterview dilewati: Tidak ditemukan data pendaftaran.');
            return;
        }

        $interviewer = DB::table('users')
            ->whereIn('role', ['instruktur'])
            ->first();

        if (!$interviewer) {
            $this->command->warn('Seeder JadwalInterview dilewati: Tidak ditemukan user interviewer (instruktur/admin).');
            return;
        }

        $jadwalInterviews = [];

        foreach ($pendaftarans as $index => $pendaftaran) {
            $tanggalInterview = Carbon::parse($pendaftaran->tanggal_daftar)->addDays(3);

            $jamMulai = 8; // Jam 8 pagi
            $menitMulai = ($index % 12) * 20;
            $tambahanHari = floor($index / 12);

            $waktuInterview = $tanggalInterview
                ->copy()
                ->addDays($tambahanHari)
                ->setTime($jamMulai, 0, 0)
                ->addMinutes($menitMulai);

            $jadwalInterviews[] = [
                'pendaftaran_id'      => $pendaftaran->id,
                'interviewer_user_id' => $interviewer->id,
                'waktu_interview'     => $waktuInterview->format('Y-m-d H:i:s'),
                'tempat_atau_link'    => ($index % 2 == 0)
                    ? 'Ruang A1 - Gedung BLK Situbondo'
                    : 'https://meet.google.com/sim-pelja-interview',
                'created_at'          => $now,
                'updated_at'          => $now,
            ];
        }

        DB::table('jadwal_interview')->insert($jadwalInterviews);
    }
}
