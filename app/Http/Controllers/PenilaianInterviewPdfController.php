<?php

namespace App\Http\Controllers;

use App\Models\PenilaianInterview;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PenilaianInterviewPdfController extends Controller
{
    public function generate(Request $request)
    {
        $ids = explode(',', $request->ids);

        $peserta = PenilaianInterview::with([
            'jadwalInterview.pendaftaran.pelatihan',
            'jadwalInterview.pendaftaran.user.profil',
        ])
            ->whereIn('id', $ids)
            ->get();

        // Ambil data pelatihan dari peserta pertama
        $pelatihan = $peserta->first()?->jadwalInterview?->pendaftaran?->pelatihan;

        // Ambil data Kabid
        $kabid = User::with('profil')
            ->where('role', 'kabid')
            ->first();

        $pdf = Pdf::loadView(
            'pdf.daftar_peserta_lulus_interview',
            compact('peserta', 'pelatihan', 'kabid')
        )->setPaper('A4', 'portrait');

        return $pdf->stream('Daftar_Peserta_Lulus_Interview.pdf');
    }
}
