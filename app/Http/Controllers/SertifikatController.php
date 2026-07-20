<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Sertifikat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class SertifikatController extends Controller
{
    public function download($kelulusanId)
    {
        $kelulusan = Pendaftaran::with(['user.profil', 'pelatihan'])->findOrFail($kelulusanId);

        if (Auth::user()->role === 'peserta' && $kelulusan->user_id !== Auth::id()) {
            abort(403, 'Anda tidak memiliki hak akses untuk mengunduh sertifikat ini.');
        }

        $sertifikat = Sertifikat::where('pendaftaran_id', $kelulusanId)->firstOrFail();

        $data = [
            'nama_peserta' => $kelulusan->user->profil->nama_lengkap ?? $kelulusan->user->name,
            'nomor_sertifikat' => $sertifikat->nomor_sertifikat,
            'nomor_sk_kadis'   => $sertifikat->nomor_sk_kadis,
            'tanggal_sk_kadis' => $sertifikat->tanggal_sk_kadis,
            'durasi_pelatihan' => $sertifikat->durasi_pelatihan,
            'nama_pelatihan' => $kelulusan->pelatihan->nama_pelatihan,
            'penandatangan_nama' => $sertifikat->ditandatangani_oleh_nama,
            'penandatangan_nip' => $sertifikat->ditandatangani_oleh_nip,
            'tanggal_terbit' => $sertifikat->tanggal_terbit,
        ];

        $pdf = Pdf::loadView('pdf.sertifikat', $data)
            ->setPaper([0, 0, 612, 936], 'landscape');
        return $pdf->stream("Sertifikat-{$data['nama_peserta']}.pdf");
    }
}
