<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BuktiPendaftaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        // Ambil seluruh record pendaftaran yang berhasil dimasukkan
        $pendaftarans = DB::table('pendaftaran')->get();

        if ($pendaftarans->isEmpty()) {
            $this->command->warn('Seeder BuktiPendaftaran dilewati: Tidak ditemukan data pendaftaran.');
            return;
        }

        $buktiPendaftarans = [];

        foreach ($pendaftarans as $pendaftaran) {
            $datePrefix = Carbon::parse($pendaftaran->tanggal_daftar)->format('Ymd');

            // Menggunakan sprintf untuk menghasilkan nomor registrasi yang terjamin Unik
            // Contoh output: REG-20251015-1, REG-20251015-2, dst.
            $nomorRegistrasi = sprintf("REG-%s-%d", $datePrefix, $pendaftaran->id);

            $buktiPendaftarans[] = [
                'pendaftaran_id'   => $pendaftaran->id,
                'nomor_registrasi' => $nomorRegistrasi,
                'file_bukti_path'  => "bukti-pendaftaran/bukti-{$pendaftaran->id}.pdf",
                'tanggal_issued'   => Carbon::parse($pendaftaran->tanggal_daftar)->setTime(8, 0, 0),
                'created_at'       => $now,
                'updated_at'       => $now,
            ];
        }

        DB::table('bukti_pendaftaran')->insert($buktiPendaftarans);
    }
}
