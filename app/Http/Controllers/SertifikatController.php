<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Penilaian;
use App\Models\Sertifikat;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class SertifikatController extends Controller
{
    public function download($kelulusanId)
    {
        $kelulusan = Pendaftaran::with([
            'user.profil',
            'pelatihan',
        ])->findOrFail($kelulusanId);

        /*
        |--------------------------------------------------------------------------
        | Hak akses peserta
        |--------------------------------------------------------------------------
        */

        if (
            Auth::user()->role === 'peserta' &&
            $kelulusan->user_id !== Auth::id()
        ) {
            abort(
                403,
                'Anda tidak memiliki hak akses untuk mengunduh sertifikat ini.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Data sertifikat
        |--------------------------------------------------------------------------
        */

        $sertifikat = Sertifikat::where(
            'pendaftaran_id',
            $kelulusanId
        )->firstOrFail();

        /*
        |--------------------------------------------------------------------------
        | Ambil nilai peserta berdasarkan USER dan PELATIHAN
        |--------------------------------------------------------------------------
        |
        | Menggunakan tabel penilaians secara langsung agar tidak mengambil
        | nilai dari pelatihan lain.
        |
        */

        $nilai = Penilaian::where('user_id', $kelulusan->user_id)
            ->where('pelatihans_id', $kelulusan->pelatihan->id)
            ->first();

        /*
        |--------------------------------------------------------------------------
        | Nilai
        |--------------------------------------------------------------------------
        */

        $nilaiTeori = $nilai->nilai_teori ?? 0;

        $nilaiPraktek = $nilai->nilai_praktek ?? 0;

        $nilaiAkhir = $nilai->nilai_akhir ?? 0;

        /*
        |--------------------------------------------------------------------------
        | Status
        |--------------------------------------------------------------------------
        */

        $statusNilai = $nilaiAkhir >= 70
            ? 'LULUS'
            : 'TIDAK LULUS';

        /*
        |--------------------------------------------------------------------------
        | Data PDF
        |--------------------------------------------------------------------------
        */

        $data = [

            // Identitas peserta
            'nama_peserta' =>
            $kelulusan->user->profil->nama_lengkap
                ?? $kelulusan->user->name,

            'nik' =>
            $kelulusan->user->nomor_identitas
                ?? '-',

            // Sertifikat
            'nomor_sertifikat' =>
            $sertifikat->nomor_sertifikat,

            'nomor_sk_kadis' =>
            $sertifikat->nomor_sk_kadis,

            'tanggal_sk_kadis' =>
            $sertifikat->tanggal_sk_kadis,

            'durasi_pelatihan' =>
            $sertifikat->durasi_pelatihan,

            'nama_pelatihan' =>
            $kelulusan->pelatihan->nama_pelatihan,

            // Penandatangan
            'penandatangan_nama' =>
            $sertifikat->ditandatangani_oleh_nama,

            'penandatangan_nip' =>
            $sertifikat->ditandatangani_oleh_nip,

            'tanggal_terbit' =>
            $sertifikat->tanggal_terbit,

            // Nilai
            'nilai_teori' =>
            $nilaiTeori,

            'nilai_praktek' =>
            $nilaiPraktek,

            'nilai_akhir' =>
            $nilaiAkhir,

            'status_nilai' =>
            $statusNilai,
        ];

        /*
        |--------------------------------------------------------------------------
        | PDF Legal Landscape
        |--------------------------------------------------------------------------
        */

        $pdf = Pdf::loadView('pdf.sertifikat', $data)
            ->setPaper('a4', 'landscape');

        return $pdf->stream(
            "Sertifikat-{$data['nama_peserta']}.pdf"
        );
    }
}
