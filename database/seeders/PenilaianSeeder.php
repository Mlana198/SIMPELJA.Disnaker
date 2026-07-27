<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PenilaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $instrukturId = DB::table('users')
            ->where('role', 'instruktur')
            ->value('id') ?? 1;

        $pelatihanIds = DB::table('pelatihans')->pluck('id');

        $pesertaIds = DB::table('users')
            ->pluck('id');

        if ($pelatihanIds->isEmpty() || $pesertaIds->isEmpty()) {
            $this->command->warn('Data pelatihan atau peserta dengan role "peserta" tidak ditemukan. Seeder penilaian dilewati.');
            return;
        }

        $dataPenilaian = [];

        foreach ($pelatihanIds as $pelatihanId) {
            foreach ($pesertaIds as $pesertaId) {
                $nilaiTeori = rand(65, 95);
                $nilaiPraktek = rand(70, 98);
                $nilaiAkhir = ($nilaiTeori * 0.4) + ($nilaiPraktek * 0.6);

                $dataPenilaian[] = [
                    'pelatihans_id'      => $pelatihanId,
                    'user_id'           => $pesertaId,
                    'nilai_teori'        => $nilaiTeori,
                    'nilai_praktek'      => $nilaiPraktek,
                    'nilai_akhir'        => round($nilaiAkhir, 2),
                    'catatan_instruktur' => 'Evaluasi hasil pelaksanaan pelatihan.',
                    'instruktur_id'      => $instrukturId,
                    'created_at'         => Carbon::now(),
                    'updated_at'         => Carbon::now(),
                ];
            }
        }

        DB::table('penilaian')->insert($dataPenilaian);
    }
}
