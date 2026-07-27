<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SertifikatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pendaftaranLulus = DB::table('pendaftaran')
            ->where('status_kelulusan', 'lulus')
            ->get();

        if ($pendaftaranLulus->isEmpty()) {
            $this->command->warn('Tidak ditemukan peserta lulus pada tabel pendaftaran. Seeder sertifikat dilewati.');
            return;
        }

        $dataSertifikat = [];
        $counter = 1;

        foreach ($pendaftaranLulus as $pendaftaran) {
            $noUrut = sprintf('%02d', $counter++);
            $bulanRomawi = $this->getBulanRomawi(Carbon::now()->month);
            $pelatihan = DB::table('pelatihans')->where('id', $pendaftaran->pelatihans_id)->first();
            $namaPelatihan = $pelatihan->nama_pelatihan ?? 'pelatihan';
            $kodeProgram = 'PBK-' . \Illuminate\Support\Str::slug($namaPelatihan, '-');
            $tahun = Carbon::now()->year;

            $nomorSertifikat = "({$noUrut}/{$bulanRomawi}/{$kodeProgram}/{$tahun})";

            $nomorSkKadis = '188/104/431.306.2.1/2025';

            $dataSertifikat[] = [
                'pendaftaran_id'          => $pendaftaran->id,
                'nomor_sertifikat'        => $nomorSertifikat,
                'ditandatangani_oleh_nama' => 'KHOLIL, S.P, M.P',
                'ditandatangani_oleh_nip' => '19680516 199203 1 012',
                'file_sertifikat_path'    => 'sertifikat/sertifikat-' . $pendaftaran->id . '.pdf',
                'tanggal_terbit'          => Carbon::now()->format('Y-m-d'),
                'nomor_sk_kadis'          => $nomorSkKadis,
                'tanggal_sk_kadis'        => '2025-01-15',
                'durasi_pelatihan'        => 32,
                'created_at'              => Carbon::now(),
                'updated_at'              => Carbon::now(),
            ];
        }

        DB::table('sertifikat')->insert($dataSertifikat);
    }

    /**
     * Helper function untuk konversi angka bulan ke Romawi
     */
    private function getBulanRomawi(int $month): string
    {
        $map = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
        ];

        return $map[$month] ?? 'I';
    }
}
