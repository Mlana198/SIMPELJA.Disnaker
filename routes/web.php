<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\LaporanPelatihanController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\PenilaianInterviewPdfController;
use App\Http\Controllers\SertifikatController;
use App\Models\Pelatihan;
use App\Models\Pendaftaran;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Landing Page & Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [LandingPageController::class, 'index'])->name('landing.index');

Route::name('landing.')->group(function () {
    // Berita Publik
    Route::get('/berita', [LandingPageController::class, 'beritaIndex'])->name('berita.index');
    Route::get('/berita/{id}', [LandingPageController::class, 'beritaShow'])->name('berita.show');

    // Pelatihan Publik
    Route::get('/pelatihan', [LandingPageController::class, 'pelatihanIndex'])->name('pelatihan.index');
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Protected PDF / Document Download Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/pendaftaran/{id}/download-bukti', [PendaftaranController::class, 'downloadBukti'])
        ->name('pendaftaran.bukti.download');

    Route::get('/sertifikat/download/{kelulusanId}', [SertifikatController::class, 'download'])
        ->name('sertifikat.download');

    Route::get('/pelatihan/{pelatihan}/laporan-pdf', [LaporanPelatihanController::class, 'generatePdf'])
        ->name('pelatihan.laporan.pdf');

    Route::get('/pelatihan/{id}/unduh-absensi', function ($id) {
        $pelatihan = Pelatihan::findOrFail($id);

        $peserta = Pendaftaran::where('pelatihans_id', $id)
            ->whereHas('jadwalInterview.penilaianInterview', function ($query) {
                $query->whereIn('status_akhir', ['Lulus', 'lulus'])
                    ->whereIn('status_pengajuan', ['Disetujui Kabid', 'disetujui_kabid', 'Disetujui']);
            })
            ->with('user.profil')
            ->get();

        if ($peserta->isEmpty()) {
            $peserta = Pendaftaran::where('pelatihans_id', $id)
                ->whereIn('catatan_keputusan', ['diterima', 'lulus', 'dijadwalkan_interview'])
                ->with('user.profil')
                ->get();
        }

        $kabid = User::where('role', 'kabid')
            ->orWhere('role', 'kepala_bidang')
            ->with('profil')
            ->first();

        $pdf = Pdf::loadView('pelatihan.cetak-absensi', compact('pelatihan', 'peserta', 'kabid'));
        $pdf->setPaper([0, 0, 595.28, 935.43], 'portrait');

        $namaFile = 'Daftar_Hadir_' . str_replace(' ', '_', $pelatihan->nama_pelatihan) . '.pdf';

        return $pdf->download($namaFile);
    })->name('pelatihan.unduh-absensi');
});

Route::get(
    '/penilaian-interview/pdf',
    [PenilaianInterviewPdfController::class, 'generate']
)->name('penilaian-interview.pdf');
