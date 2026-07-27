<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $pendaftarans = DB::table('pendaftaran')
            ->whereIn('status_seleksi_administrasi', ['lolos'])
            ->get();

        if ($pendaftarans->isEmpty()) {
            $this->command->warn('Seeder Absensi dilewati: Tidak ditemukan data pendaftaran peserta yang lolos.');
            return;
        }

        $absensilist = [];

        $pendaftaranPerPelatihan = $pendaftarans->groupBy('pelatihans_id');

        foreach ($pendaftaranPerPelatihan as $pelatihanId => $pesertaList) {
            $pelatihan = DB::table('pelatihans')->where('id', $pelatihanId)->first();

            $tanggalMulai = ($pelatihan && isset($pelatihan->tanggal_mulai))
                ? Carbon::parse($pelatihan->tanggal_mulai)
                : Carbon::parse('2025-11-03');

            $tanggalSelesai = ($pelatihan && isset($pelatihan->tanggal_selesai))
                ? Carbon::parse($pelatihan->tanggal_selesai)
                : $tanggalMulai->copy()->addDays(4);

            $periodePelatihan = CarbonPeriod::create($tanggalMulai, $tanggalSelesai);

            foreach ($periodePelatihan as $tanggal) {

                if ($tanggal->isWeekend()) {
                    continue;
                }

                $tanggalStr = $tanggal->format('Y-m-d');

                foreach ($pesertaList as $index => $peserta) {

                    $rand = rand(1, 100);
                    if ($rand <= 88) {
                        $status = 'hadir';
                    } elseif ($rand <= 94) {
                        $status = 'izin';
                    } elseif ($rand <= 98) {
                        $status = 'sakit';
                    } else {
                        $status = 'alpa';
                    }

                    $absensilist[] = [
                        'pelatihans_id'   => $pelatihanId,
                        'user_id'         => $peserta->user_id,
                        'tanggal'         => $tanggalStr,
                        'status_kehadiran' => $status,
                        'created_at'      => $now,
                        'updated_at'      => $now,
                    ];
                }
            }
        }

        if (!empty($absensilist)) {
            foreach (array_chunk($absensilist, 500) as $chunk) {
                DB::table('absensi')->insert($chunk);
            }
        }
    }
}
