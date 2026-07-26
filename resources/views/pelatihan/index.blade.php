<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelatihan - SIM-PELJA</title>
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
            <h1 class="text-base font-bold text-slate-900">Program Pelatihan Kerja</h1>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-slate-900">Daftar Pelatihan Aktif</h2>
            <p class="text-slate-500 text-sm mt-1">Pilih program pelatihan kerja yang sedang dibuka untuk meningkatkan
                keterampilan Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($pelatihans as $pelatihan)
                <div
                    class="bg-white rounded-xl border border-slate-200 overflow-hidden shadow-sm flex flex-col justify-between hover:shadow-md transition-shadow">

                    <div>
                        <!-- Gambar Pelatihan -->
                        @if ($pelatihan->foto)
                            <img src="{{ asset('storage/' . $pelatihan->foto) }}" alt="{{ $pelatihan->nama_pelatihan }}"
                                class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-slate-100 flex items-center justify-center text-slate-400">
                                <span class="material-symbols-outlined text-4xl">model_training</span>
                            </div>
                        @endif

                        <div class="p-5">
                            <!-- Badge Angkatan & Status -->
                            <div class="flex items-center justify-between mb-3">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                                    Angkatan {{ $pelatihan->angkatan }}
                                </span>
                                <span class="inline-flex items-center gap-1 text-xs font-medium text-slate-500">
                                    <span class="material-symbols-outlined text-sm text-slate-400">groups</span>
                                    Kuota: {{ $pelatihan->kuota }} Peserta
                                </span>
                            </div>

                            <!-- Judul Pelatihan -->
                            <h3 class="text-lg font-bold text-slate-900 mb-2 line-clamp-1">
                                {{ $pelatihan->nama_pelatihan }}
                            </h3>

                            <!-- Tanggal Pelaksanaan -->
                            <div class="flex items-center gap-1.5 text-xs text-slate-500 mb-3">
                                <span class="material-symbols-outlined text-sm text-slate-400">calendar_month</span>
                                <span>
                                    {{ \Carbon\Carbon::parse($pelatihan->tanggal_mulai)->translatedFormat('d M Y') }} -
                                    {{ \Carbon\Carbon::parse($pelatihan->tanggal_selesai)->translatedFormat('d M Y') }}
                                </span>
                            </div>

                            <!-- Deskripsi -->
                            <p class="text-slate-600 text-sm line-clamp-3">
                                {{ strip_tags($pelatihan->deskripsi) }}
                            </p>
                        </div>
                    </div>

                    <!-- Footer Card / Tombol Aksi -->
                    <div class="p-5 pt-0">
                        @auth
                            <a href="{{ route('login') }}"
                                class="w-full inline-flex justify-center items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2.5 px-4 rounded-lg transition-colors shadow-sm">
                                Daftar Sekarang
                                <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                                class="w-full inline-flex justify-center items-center gap-2 bg-slate-900 hover:bg-slate-800 text-white text-sm font-semibold py-2.5 px-4 rounded-lg transition-colors shadow-sm">
                                Login untuk Mendaftar
                                <span class="material-symbols-outlined text-sm">login</span>
                            </a>
                        @endauth
                    </div>

                </div>
            @empty
                <div
                    class="col-span-full text-center py-16 bg-white rounded-xl border border-dashed border-slate-200 text-slate-400">
                    <span class="material-symbols-outlined text-5xl mb-2 text-slate-300">model_training</span>
                    <p class="text-base font-medium text-slate-600">Saat ini belum ada pelatihan aktif yang dibuka.</p>
                    <p class="text-xs text-slate-400 mt-1">Silakan cek kembali secara berkala untuk pembaruan jadwal
                        pelatihan.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $pelatihans->links() }}
        </div>
    </main>

</body>

</html>
