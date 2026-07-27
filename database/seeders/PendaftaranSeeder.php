<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // 1. Ambil Pelatihan Content Creator Angkatan 1, 2, dan 3
        $pelatihan1 = DB::table('pelatihans')->where('nama_pelatihan', 'Pelatihan Content Creator')->where('angkatan', 1)->first();
        $pelatihan2 = DB::table('pelatihans')->where('nama_pelatihan', 'Pelatihan Content Creator')->where('angkatan', 2)->first();
        $pelatihan3 = DB::table('pelatihans')->where('nama_pelatihan', 'Pelatihan Content Creator')->where('angkatan', 3)->first();

        // 2. Ambil HANYA user dengan role 'peserta'
        $pesertaIds = DB::table('users')
            ->where('role', 'peserta')
            ->orderBy('id', 'asc')
            ->pluck('id')
            ->toArray();

        if (empty($pesertaIds)) {
            $this->command->warn('Seeder Pendaftaran dilewati: Tidak ditemukan pengguna ber-role "peserta".');
            return;
        }

        $pendaftarans = [];

        // Skenario 1: Angkatan 1 (2025) - 16 Peserta Lolos & Lulus
        if ($pelatihan1) {
            $pesertaAngkatan1 = array_slice($pesertaIds, 0, 16);

            foreach ($pesertaAngkatan1 as $userId) {
                $pendaftarans[] = [
                    'user_id'                     => $userId,
                    'pelatihans_id'               => $pelatihan1->id,
                    'tanggal_daftar'              => '2025-10-15',
                    'status_seleksi_administrasi' => 'lolos',
                    'status_kelulusan'            => 'lulus',
                    'is_sent_to_koordinator'      => 1,
                    'catatan_keputusan'           => 'Lolos seleksi administrasi dan dinyatakan lulus.',
                    'is_notified'                 => 1,
                    'created_at'                  => $now,
                    'updated_at'                  => $now,
                ];
            }
        }

        // Skenario 2: Angkatan 2 (2026) - Peserta Aktif/Berjalan (Jika ada sisa peserta)
        if ($pelatihan2 && count($pesertaIds) > 16) {
            $pesertaAngkatan2 = array_slice($pesertaIds, 16, 5);

            foreach ($pesertaAngkatan2 as $userId) {
                $pendaftarans[] = [
                    'user_id'                     => $userId,
                    'pelatihans_id'               => $pelatihan2->id,
                    'tanggal_daftar'              => '2026-06-20',
                    'status_seleksi_administrasi' => 'lolos',
                    'status_kelulusan'            => 'pending',
                    'is_sent_to_koordinator'      => 1,
                    'catatan_keputusan'           => 'Berkas lengkap, sedang dalam periode pelatihan.',
                    'is_notified'                 => 1,
                    'created_at'                  => $now,
                    'updated_at'                  => $now,
                ];
            }
        }

        // Skenario 3: Angkatan 3 (2026) - Pendaftaran Baru (Pending)
        if ($pelatihan3 && count($pesertaIds) > 21) {
            $pesertaAngkatan3 = array_slice($pesertaIds, 21, 3);

            foreach ($pesertaAngkatan3 as $userId) {
                $pendaftarans[] = [
                    'user_id'                     => $userId,
                    'pelatihans_id'               => $pelatihan3->id,
                    'tanggal_daftar'              => '2026-07-25',
                    'status_seleksi_administrasi' => 'pending',
                    'status_kelulusan'            => 'pending',
                    'is_sent_to_koordinator'      => 0,
                    'catatan_keputusan'           => null,
                    'is_notified'                 => 0,
                    'created_at'                  => $now,
                    'updated_at'                  => $now,
                ];
            }
        }

        if (!empty($pendaftarans)) {
            DB::table('pendaftaran')->insert($pendaftarans);
        }
    }
}
