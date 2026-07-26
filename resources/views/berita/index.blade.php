<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Berita - SIM-PELJA</title>
    @vite('resources/css/app.css')
    <link rel="icon" href="{{ asset('logos/disnaker.png?v=1') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body class="bg-slate-50 text-slate-800 font-sans">

    <!-- Header Navigation -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <a href="{{ url('/') }}"
                class="flex items-center gap-2 text-slate-600 hover:text-slate-900 transition-colors text-sm font-semibold">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Kembali ke Beranda
            </a>
            <h1 class="text-base font-bold text-slate-900">Arsip Berita & Informasi</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-slate-900">Semua Berita</h2>
            <p class="text-slate-500 text-sm mt-1">Informasi dan pengumuman terbaru seputar pelatihan kerja.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($beritas as $berita)
                <div
                    class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">
                    <div>
                        @if ($berita->foto_banner)
                            <img src="{{ asset('storage/' . $berita->foto_banner) }}" alt="{{ $berita->judul }}"
                                class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-slate-100 flex items-center justify-center text-slate-400">
                                <span class="material-symbols-outlined text-4xl">newspaper</span>
                            </div>
                        @endif

                        <div class="p-5">
                            <span class="text-xs font-semibold text-blue-600">
                                {{ \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('d F Y') }}
                            </span>
                            <h3 class="text-lg font-bold text-slate-900 mt-2 line-clamp-2">
                                {{ $berita->judul }}
                            </h3>
                            <p class="text-slate-500 text-sm mt-2 line-clamp-3">
                                {{ strip_tags($berita->konten) }}
                            </p>
                        </div>
                    </div>

                    <div class="p-5 pt-0">
                        <a href="{{ route('landing.berita.show', $berita->id) }}"
                            class="inline-flex items-center gap-1 text-sm font-semibold text-blue-600 hover:text-blue-800">
                            Baca Selengkapnya
                            <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </a>
                    </div>
                </div>
            @empty
                <div
                    class="col-span-full text-center py-12 bg-white rounded-xl border border-dashed border-slate-200 text-slate-400">
                    <span class="material-symbols-outlined text-4xl mb-2">newspaper</span>
                    <p class="text-sm">Belum ada berita yang diterbitkan.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $beritas->links() }}
        </div>
    </main>

</body>

</html>
