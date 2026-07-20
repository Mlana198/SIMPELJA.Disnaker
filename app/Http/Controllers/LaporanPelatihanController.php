<?php

namespace App\Http\Controllers;

use App\Models\Pelatihan;
use App\Models\Penilaian;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanPelatihanController extends Controller
{
    public function generatePdf(Pelatihan $pelatihan)
    {
        $pendaftarans = $pelatihan->pendaftarans();
        $totalPendaftar = (clone $pendaftarans)->count();
        $lolosAdministrasi = (clone $pendaftarans)
            ->where('status_seleksi_administrasi', 'lolos')
            ->count();
        $lolosInterview = (clone $pendaftarans)
            ->whereHas('jadwalInterview.penilaianInterview', function ($query) {
                $query->where('status_akhir', 'Lulus');
            })->count();
        $totalLulusPelatihan = (clone $pendaftarans)
            ->whereHas('user.penilaians', function ($query) use ($pelatihan) {
                $query->where('pelatihans_id', $pelatihan->id);
            })->count();
        $rataRataNilai = Penilaian::where('pelatihans_id', $pelatihan->id)
            ->avg('nilai_akhir') ?? 0;
        $peserta = $pelatihan->pendaftarans()
            ->whereHas('user.penilaians', function ($query) use ($pelatihan) {
                $query->where('pelatihans_id', $pelatihan->id);
            })
            ->with([
                'user.profil',
                'user.penilaians' => function ($query) use ($pelatihan) {
                    $query->where('pelatihans_id', $pelatihan->id);
                }
            ])
            ->get();
        $kabid = User::where('role', 'kabid')
            ->with('profil')
            ->first();
        $data = [
            'pelatihan' => $pelatihan,
            'total_pendaftar' => $totalPendaftar,
            'lolos_administrasi' => $lolosAdministrasi,
            'lolos_interview' => $lolosInterview,
            'total_lulus' => $totalLulusPelatihan,
            'rata_rata_nilai' => round($rataRataNilai, 2),
            'tanggal_cetak' => now()->translatedFormat('d F Y'),
            'peserta' => $peserta,
            'kabid' => $kabid,
        ];
        $pdf = Pdf::loadView('pdf.laporan_pelatihan', $data);

        return $pdf->stream("Laporan-Pelatihan-{$pelatihan->nama_pelatihan}.pdf");
    }
}
