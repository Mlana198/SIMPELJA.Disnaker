<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <link rel="icon" href="{{ asset('logos/disnaker.png?v=1') }}">
    <title>SIM-PELJA | Dinas Ketenagakerjaan Kabupaten Situbondo</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Manrope:wght@600;700;800&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Slider Logic
            const slides = document.querySelectorAll('.slide');
            const dots = document.querySelectorAll('.dot');
            let current = 0;

            function showSlide(index) {
                slides.forEach((slide, i) => {
                    slide.style.opacity = i === index ? '1' : '0';
                    dots[i].classList.toggle('bg-white', i === index);
                    dots[i].classList.toggle('bg-white/50', i !== index);
                });
            }

            function nextSlide() {
                current = (current + 1) % slides.length;
                showSlide(current);
            }

            setInterval(nextSlide, 5000);

            dots.forEach((dot, i) => {
                dot.addEventListener('click', () => {
                    current = i;
                    showSlide(current);
                });
            });

            showSlide(0);

            // Mobile Menu Logic (Perbaikan pengganti el-dialog)
            const menuButton = document.getElementById('btn-open-menu');
            const closeButton = document.getElementById('btn-close-menu');
            const mobileMenu = document.getElementById('mobile-menu');

            menuButton.addEventListener('click', () => {
                mobileMenu.classList.remove('hidden');
            });

            closeButton.addEventListener('click', () => {
                mobileMenu.classList.add('hidden');
            });
        });
    </script>

    <style>
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 80px;
            /* Mencegah konten tertutup oleh Header Sticky */
        }

        @keyframes slide-top {
            0% {
                transform: translateY(30px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .slide-top {
            animation: slide-top 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        body {
            font-family: "Inter", sans-serif;
        }

        h1,
        h2,
        h3,
        .font-headline {
            font-family: "Manrope", sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased">
    <main class="flex flex-col w-full min-w-0">

        {{-- HEADER & NAVBAR --}}
        <header class="sticky top-0 z-50 bg-blue-600 shadow-md">
            <nav aria-label="Global" class="flex items-center justify-between p-4 lg:px-8 max-w-7xl mx-auto">
                <div class="flex lg:flex-1">
                    <a href="/started" class="flex items-center gap-3">
                        <img src="{{ asset('logos/disnaker.png') }}" alt="Logo Disnaker"
                            class="h-10 w-auto object-contain" />
                        <span
                            class="text-white font-bold tracking-wide text-sm lg:text-base font-headline">SIM-PELJA</span>
                    </a>
                </div>

                {{-- Hamburger Button Mobile --}}
                <div class="flex lg:hidden">
                    <button type="button" id="btn-open-menu"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-white focus:outline-none">
                        <span class="sr-only">Buka Menu Utama</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </button>
                </div>

                {{-- Desktop Navigation Links --}}
                <div class="hidden lg:flex lg:gap-x-10">
                    <a href="#beranda"
                        class="text-sm font-medium text-white hover:text-blue-200 transition-colors">Beranda</a>
                    <a href="#berita"
                        class="text-sm font-medium text-white hover:text-blue-200 transition-colors">Berita</a>
                    <a href="#pelatihan"
                        class="text-sm font-medium text-white hover:text-blue-200 transition-colors">Pelatihan</a>
                    <a href="#tentang-kami"
                        class="text-sm font-medium text-white hover:text-blue-200 transition-colors">Tentang Kami</a>
                </div>

                {{-- User Authentication Icon Trigger --}}
                <div class="hidden lg:flex lg:flex-1 lg:justify-end">
                    @auth
                        <a href="/{{ auth()->user()->role }}"
                            class="inline-flex items-center gap-1 text-sm font-semibold text-white bg-blue-700 hover:bg-blue-800 px-4 py-2 rounded-xl transition-all shadow-sm">
                            <span class="material-symbols-outlined">dashboard</span> Panel
                            {{ ucfirst(auth()->user()->role) }}
                        </a>
                    @else
                        <a href="/login"
                            class="inline-flex items-center gap-1 text-sm font-semibold text-white bg-blue-700 hover:bg-blue-800 px-4 py-2 rounded-xl transition-all shadow-sm">
                            <span class="material-symbols-outlined">login</span> Masuk / Daftar
                        </a>
                    @endauth
                </div>
            </nav>

            {{-- Mobile Menu Modal (Native HTML & JS Engine Fix) --}}
            <div id="mobile-menu" class="hidden fixed inset-0 z-50 lg:hidden" role="dialog" aria-modal="true">
                <div class="fixed inset-0 bg-black/40 backdrop-blur-sm"></div>
                <div
                    class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white p-6 sm:max-w-sm sm:ring-1 sm:ring-slate-900/10 shadow-2xl flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between border-b pb-4">
                            <a href="#" class="flex items-center gap-2">
                                <img src="{{ asset('logos/disnaker.png') }}" alt="Logo" class="h-8 w-auto" />
                                <span class="text-slate-900 font-bold font-headline">SIM-PELJA</span>
                            </a>
                            <button type="button" id="btn-close-menu"
                                class="-m-2.5 rounded-md p-2.5 text-slate-700 focus:outline-none">
                                <span class="sr-only">Tutup Menu</span>
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <div class="mt-6 space-y-2">
                            <a href="#beranda"
                                class="block rounded-lg px-3 py-2 text-base font-semibold text-slate-900 hover:bg-slate-50">Beranda</a>
                            <a href="#berita"
                                class="block rounded-lg px-3 py-2 text-base font-semibold text-slate-900 hover:bg-slate-50">Berita</a>
                            <a href="#pelatihan"
                                class="block rounded-lg px-3 py-2 text-base font-semibold text-slate-900 hover:bg-slate-50">Pelatihan</a>
                            <a href="#tentang-kami"
                                class="block rounded-lg px-3 py-2 text-base font-semibold text-slate-900 hover:bg-slate-50">Tentang
                                Kami</a>
                        </div>
                    </div>
                    <div class="border-t pt-4">
                        @auth
                            <a href="/{{ auth()->user()->role }}"
                                class="block w-full text-center rounded-xl bg-blue-600 px-3 py-2.5 text-base font-semibold text-white shadow-sm hover:bg-blue-700">Masuk
                                Panel</a>
                        @else
                            <a href="/login"
                                class="block w-full text-center rounded-xl bg-blue-600 px-3 py-2.5 text-base font-semibold text-white shadow-sm hover:bg-blue-700">Login
                                / Registrasi</a>
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        {{-- BANNER CAROUSEL SLIDER --}}
        <div id="beranda" class="w-full h-64 md:h-96 lg:h-112.5 relative overflow-hidden bg-slate-900">
            <div id="slider" class="w-full h-full relative">
                <div class="slide absolute inset-0 opacity-100 transition-opacity duration-1000 ease-in-out">
                    <img src="{{ asset('logos/foto1.png') }}" class="w-full h-full object-cover object-center"
                        alt="Slide 1">
                    <div class="absolute inset-0 bg-linear-to-r from-slate-900/80 via-slate-900/40 to-transparent">
                    </div>
                </div>
                <div class="slide absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out">
                    <img src="{{ asset('logos/foto2.png') }}" class="w-full h-full object-cover object-center"
                        alt="Slide 2">
                    <div class="absolute inset-0 bg-linear-to-r from-slate-900/80 via-slate-900/40 to-transparent">
                    </div>
                </div>
                <div class="slide absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out">
                    <img src="{{ asset('logos/foto3.png') }}" class="w-full h-full object-cover object-center"
                        alt="Slide 3">
                    <div class="absolute inset-0 bg-linear-to-r from-slate-900/80 via-slate-900/40 to-transparent">
                    </div>
                </div>
            </div>

            <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                <button
                    class="dot w-3 h-3 bg-white rounded-full focus:outline-none transition-all duration-300 shadow-sm"></button>
                <button
                    class="dot w-3 h-3 bg-white/50 rounded-full focus:outline-none transition-all duration-300 shadow-sm"></button>
                <button
                    class="dot w-3 h-3 bg-white/50 rounded-full focus:outline-none transition-all duration-300 shadow-sm"></button>
            </div>
        </div>

        {{-- SECTION BERITA --}}
        <section id="berita" class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex justify-between items-end mb-8 border-b pb-4">
                <div>
                    <h2 class="text-2xl font-bold font-headline text-slate-900">Berita Terbaru</h2>
                    <p class="text-slate-500 text-sm mt-1">Informasi terkini seputar ketenagakerjaan dan kegiatan
                        instansi</p>
                </div>
                <a href="{{ route('landing.berita.index') }}"
                    class="text-blue-600 text-sm font-semibold hover:text-blue-800 flex items-center gap-1 transition-colors">
                    Lihat Semua <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($beritas as $index => $berita)
                    <div class="bg-white rounded-2xl shadow-sm hover:shadow-md border border-slate-100 overflow-hidden slide-top flex flex-col justify-between transition-all duration-300 hover:-translate-y-1"
                        style="animation-delay: {{ ($index + 1) * 0.1 }}s">
                        <div>
                            <div class="relative h-48 w-full bg-slate-100">
                                <img src="{{ $berita->foto_banner ? asset('storage/' . $berita->foto_banner) : asset('logos/foto1.png') }}"
                                    class="w-full h-full object-cover" alt="{{ $berita->judul }}">
                                <span
                                    class="absolute top-3 left-3 bg-blue-600 text-white text-[10px] font-bold px-2 py-1 rounded-md uppercase tracking-wider">Berita</span>
                            </div>
                            <div class="p-5">
                                <div class="text-xs text-slate-400 font-medium mb-2 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">calendar_month</span>
                                    {{ \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('d M Y') }}
                                </div>
                                <h3
                                    class="text-base font-bold text-slate-900 line-clamp-2 hover:text-blue-600 transition-colors mb-2 font-headline">
                                    {{ $berita->judul }}
                                </h3>
                                <p class="text-slate-600 text-sm line-clamp-3 leading-relaxed">
                                    {{ strip_tags($berita->konten) }}
                                </p>
                            </div>
                        </div>
                        <div class="p-5 pt-0 border-t border-slate-50 mt-4">
                            <a href="{{ route('landing.berita.show', $berita->slug ?? $berita->id) }}"
                                class="text-blue-600 text-xs font-bold hover:text-blue-800 inline-flex items-center gap-1">
                                Baca Selengkapnya <span class="material-symbols-outlined text-xs">chevron_right</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full text-center py-12 bg-white rounded-2xl border border-dashed border-slate-200 text-slate-400">
                        <span class="material-symbols-outlined text-4xl mb-2">newspaper</span>
                        <p class="text-sm">Belum ada berita terbaru yang diterbitkan.</p>
                    </div>
                @endforelse
            </div>
        </section>

        {{-- SECTION PELATIHAN --}}
        <section id="pelatihan" class="max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="flex justify-between items-end mb-8 border-b pb-4">
                <div>
                    <h2 class="text-2xl font-bold font-headline text-slate-900">Program Pelatihan Aktif</h2>
                    <p class="text-slate-500 text-sm mt-1">Eksplorasi kejuruan kompetensi gratis bagi masyarakat
                        Kabupaten Situbondo</p>
                </div>
                <a href="{{ route('landing.pelatihan.index') }}"
                    class="text-blue-600 text-sm font-semibold hover:text-blue-800 flex items-center gap-1 transition-colors">
                    Lihat Semua <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                @forelse($pelatihans as $index => $pelatihan)
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col sm:flex-row slide-top transition-all duration-300 hover:shadow-md hover:-translate-y-1"
                        style="animation-delay: {{ ($index + 1) * 0.1 }}s">
                        <div
                            class="w-full sm:w-2/5 h-48 sm:h-auto relative bg-slate-50 flex items-center justify-center p-4">
                            <img src="{{ $pelatihan->foto ? asset('storage/' . $pelatihan->foto) : asset('logos/Logo Dinsos.jpg') }}"
                                class="w-full h-full object-contain rounded-xl"
                                alt="{{ $pelatihan->nama_pelatihan }}">
                        </div>
                        <div
                            class="p-6 flex flex-col justify-between w-full sm:w-3/5 border-t sm:border-t-0 sm:border-l border-slate-50">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span
                                        class="bg-emerald-50 text-emerald-700 text-[10px] font-bold px-2 py-1 rounded-md uppercase tracking-wider">Kuota
                                        Tersedia</span>
                                    <span class="text-slate-400 text-xs font-semibold">Angkatan
                                        {{ $pelatihan->angkatan }}</span>
                                </div>
                                <h3 class="text-base font-bold text-slate-900 line-clamp-2 font-headline mb-2">
                                    {{ $pelatihan->nama_pelatihan }}
                                </h3>
                                <p class="text-slate-500 text-xs line-clamp-3 leading-relaxed">
                                    {{ strip_tags($pelatihan->deskripsi) }}
                                </p>
                            </div>
                            <div class="mt-4 pt-4 border-t border-slate-100 flex items-center justify-between">
                                <span class="text-[11px] text-slate-400 font-medium flex items-center gap-0.5">
                                    <span class="material-symbols-outlined text-sm text-slate-400">group</span> Maks:
                                    {{ $pelatihan->kuota }} Peserta
                                </span>
                                <a href="/login"
                                    class="inline-flex items-center gap-0.5 text-xs font-bold text-blue-600 hover:text-blue-800">
                                    Daftar <span class="material-symbols-outlined text-xs">arrow_forward</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full text-center py-12 bg-white rounded-2xl border border-dashed border-slate-200 text-slate-400">
                        <span class="material-symbols-outlined text-4xl mb-2">model_training</span>
                        <p class="text-sm">Belum ada program pelatihan terbaru saat ini.</p>
                    </div>
                @endforelse
            </div>
        </section>

        {{-- SECTION TENTANG KAMI --}}
        <section id="tentang-kami" class="bg-white border-t border-b border-slate-100 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold font-headline text-slate-900">Tentang Kami</h2>
                    <p class="text-slate-500 mt-2 max-w-2xl mx-auto text-sm md:text-base">
                        Dinas Ketenagakerjaan Kabupaten Situbondo berkomitmen meningkatkan kualitas tenaga kerja melalui
                        layanan profesional, inklusif, dan berkelanjutan.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center mb-12">
                    <div class="h-64 md:h-80 w-full relative bg-slate-100 rounded-2xl overflow-hidden shadow-sm">
                        <img src="{{ asset('logos/foto2.png') }}" class="w-full h-full object-cover object-center"
                            alt="Gedung Kantor">
                    </div>
                    <div class="space-y-4">
                        <h3 class="text-xl font-bold text-slate-900 font-headline">Profil Singkat</h3>
                        <p class="text-slate-600 text-sm text-justify leading-relaxed">
                            Dinas Ketenagakerjaan Kabupaten Situbondo merupakan lembaga pemerintah daerah yang mengemban
                            mandat penuh dalam menyelenggarakan fungsi penyiapan kompetensi, perluasan kesempatan
                            penempatan, serta perlindungan tenaga kerja formal maupun informal.
                        </p>
                        <p class="text-slate-600 text-sm text-justify leading-relaxed">
                            Melalui ekosistem aplikasi SIM-PELJA, kami menghadirkan transparansi penuh atas manajemen
                            pelatihan vokasional gratis guna mencetak angkatan kerja Situbondo yang berdaya saing
                            global, mandiri, dan berintegritas.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="p-6 rounded-2xl bg-slate-50 border border-slate-100">
                        <h3 class="text-lg font-bold text-blue-600 mb-3 font-headline flex items-center gap-1.5">
                            <span class="material-symbols-outlined">visibility</span> Visi
                        </h3>
                        <p class="text-slate-700 text-sm leading-relaxed">
                            Mewujudkan angkatan kerja Kabupaten Situbondo yang kompeten, produktif, kompetitif, dan
                            adaptif dalam mendukung roda pembangunan ekonomi daerah terpadu dan berkelanjutan.
                        </p>
                    </div>
                    <div class="p-6 rounded-2xl bg-slate-50 border border-slate-100">
                        <h3 class="text-lg font-bold text-blue-600 mb-3 font-headline flex items-center gap-1.5">
                            <span class="material-symbols-outlined">assignment</span> Misi
                        </h3>
                        <ul class="text-slate-700 text-sm space-y-2 list-disc list-inside leading-relaxed">
                            <li>Meningkatkan standar kapasitas kerja vokasional berbasis sertifikasi kompetensi.</li>
                            <li>Memperluas jalinan kemitraan bursa kerja sektor industri mikro dan makro.</li>
                            <li>Menjamin kepastian iklim kerja yang aman, sehat, humanis, dan berkeadilan.</li>
                            <li>Mengembangkan layanan tata pamong berbasis digital informasi terintegrasi.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- FOOTER COMPONENT --}}
        <footer class="bg-slate-900 text-slate-400 border-t border-slate-800">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-white font-bold text-base mb-4 font-headline flex items-center gap-2">
                        <img src="{{ asset('logos/disnaker.png') }}" alt="" class="h-6 w-auto" />
                        Disnaker Situbondo
                    </h3>
                    <p class="text-xs text-justify leading-relaxed text-slate-400">
                        Pusat layanan informasi ketenagakerjaan publik terpadu di bawah naungan resmi Pemerintah
                        Kabupaten Situbondo, Jawa Timur. Berkomitmen menekan angka pengangguran melalui pemberdayaan
                        keterampilan masyarakat.
                    </p>
                </div>
                <div>
                    <h3 class="text-white font-bold text-sm mb-4 font-headline tracking-wider uppercase">Tautan
                        Navigasi</h3>
                    <ul class="space-y-2 text-xs">
                        <li><a href="#beranda"
                                class="hover:text-white transition-colors flex items-center gap-1">Beranda</a></li>
                        <li><a href="#berita" class="hover:text-white transition-colors flex items-center gap-1">Kanal
                                Berita</a></li>
                        <li><a href="#pelatihan"
                                class="hover:text-white transition-colors flex items-center gap-1">Katalog
                                Pelatihan</a></li>
                        <li><a href="#tentang-kami"
                                class="hover:text-white transition-colors flex items-center gap-1">Tentang Kami</a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-bold text-sm mb-4 font-headline tracking-wider uppercase">Sekretariat
                        Instansi</h3>
                    <ul class="text-xs space-y-3">
                        <li class="flex items-start gap-2">
                            <span class="material-symbols-outlined text-sm mt-0.5 text-slate-500">location_on</span>
                            <a href="https://maps.google.com" target="_blank"
                                class="hover:text-white leading-relaxed">
                                Jl. Pb. Sudirman, Karangasem, Patokan, Kec. Situbondo, Kabupaten Situbondo, Jawa Timur
                                68312
                            </a>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm text-slate-500">call</span>
                            <span class="leading-none">(0338) 673204</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm text-slate-500">mail</span>
                            <span class="leading-none">disnaker@situbondo.go.id</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-slate-800 text-center text-xs text-slate-500 py-4 bg-slate-950">
                &copy; 2026 Dinas Ketenagakerjaan Kabupaten Situbondo. All rights reserved.
            </div>
        </footer>
    </main>
</body>

</html>
