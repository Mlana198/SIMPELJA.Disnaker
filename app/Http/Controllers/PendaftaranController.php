<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    public function downloadBukti($id)
    {
        $pendaftaran = Pendaftaran::with(['user.profil', 'pelatihan', 'buktiPendaftaran'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($pendaftaran->status_seleksi_administrasi !== 'lolos') {
            abort(403, 'Anda belum dinyatakan lolos seleksi administrasi.');
        }

        $pdf = Pdf::loadView('pdf.bukti-pendaftaran', compact('pendaftaran'));

        $nomorReg = $pendaftaran->buktiPendaftaran->nomor_registrasi ?? $pendaftaran->id;
        $namaFile = 'Bukti_Lolos_Administrasi_' . $nomorReg . '.pdf';

        return $pdf->download($namaFile);
    }
}
