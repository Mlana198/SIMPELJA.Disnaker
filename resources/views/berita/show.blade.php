<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->judul }} - SIM-PELJA</title>
    @vite('resources/css/app.css')
    <link rel="icon" href="{{ asset('logos/disnaker.png?v=1') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body class="bg-slate-50 text-slate-800 font-sans">

    <!-- Header Navigation -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <a href="{{ route('landing.berita.index') }}"
                class="flex items-center gap-2 text-slate-600 hover:text-slate-900 transition-colors text-sm font-semibold">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Kembali ke Daftar Berita
            </a>
            <a href="{{ url('/') }}" class="text-xs text-slate-500 hover:text-slate-800">Beranda</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <article class="bg-white rounded-2xl border border-slate-200 p-6 sm:p-10 shadow-sm">

            <!-- Metadata -->
            <div class="flex items-center gap-2 text-xs font-semibold text-blue-600 mb-3">
                <span class="material-symbols-outlined text-sm">calendar_today</span>
                {{ \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('l, d F Y') }}
            </div>

            <!-- Title -->
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 leading-tight mb-6">
                {{ $berita->judul }}
            </h1>

            <!-- Banner Image -->
            @if ($berita->foto_banner)
                <div class="mb-8 rounded-xl overflow-hidden bg-slate-100 max-h-[450px]">
                    <img src="{{ asset('storage/' . $berita->foto_banner) }}" alt="{{ $berita->judul }}"
                        class="w-full h-full object-cover">
                </div>
            @endif

            <!-- Article Content -->
            <div class="prose prose-slate max-w-none leading-relaxed text-slate-700">
                {!! $berita->konten !!}
            </div>

        </article>
    </main>

</body>

</html>
