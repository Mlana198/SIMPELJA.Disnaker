<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Pelatihan;

class LandingPageController extends Controller
{
    /**
     * Halaman Depan / Landing Page Utama
     */
    public function index()
    {
        $beritas = Berita::latest('tanggal_publish')->take(3)->get();
        $pelatihans = Pelatihan::where('status_periode', 'aktif')->latest()->take(4)->get();

        return view('started', compact('beritas', 'pelatihans'));
    }

    /**
     * Halaman List Semua Berita (Saat klik 'Lihat Semua' di bagian Berita)
     */
    public function beritaIndex()
    {
        $beritas = Berita::latest('tanggal_publish')->paginate(9);
        return view('berita.index', compact('beritas'));
    }

    /**
     * Halaman Detail Berita (Saat klik 'Baca Selengkapnya' atau judul berita)
     */
    public function beritaShow($id)
    {
        $berita = Berita::findOrFail($id);

        return view('berita.show', compact('berita'));
    }

    /**
     * Halaman List Semua Pelatihan (Saat klik 'Lihat Semua' di bagian Pelatihan)
     */
    public function pelatihanIndex()
    {
        $pelatihans = Pelatihan::where('status_periode', 'aktif')->latest()->paginate(6);
        return view('pelatihan.index', compact('pelatihans'));
    }
}
