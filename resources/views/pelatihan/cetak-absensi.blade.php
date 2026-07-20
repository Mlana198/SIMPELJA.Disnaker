<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <link rel="icon" href="{{ asset('logos/disnaker.png?v=1') }}">
    <title>Daftar Hadir Peserta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            margin: 0;
            padding: 5px;
            color: #000;
        }

        /* STRUKTUR KOP SURAT DENGAN POSISI ABSOLUTE */
        .table-kop {
            width: 100%;
            border-collapse: collapse;
            border-bottom: 3px double #000;
            margin-bottom: 15px;
            position: relative;
        }

        .table-kop td {
            border: none !important;
            padding: 0 !important;
        }

        .container-logo {
            position: absolute;
            top: -5px;
            left: 15px;
            z-index: 10;
        }

        .cell-teks {
            width: 100%;
            text-align: center;
            padding-bottom: 10px !important;
            padding-top: 5px !important;
        }

        .cell-teks h2 {
            margin: 0;
            font-size: 13pt;
            text-transform: uppercase;
            font-weight: bold;
        }

        .cell-teks h3 {
            margin: 2px 0;
            font-size: 14pt;
            text-transform: uppercase;
            font-weight: bold;
        }

        .cell-teks p {
            margin: 3px;
            font-size: 8.5pt;
            font-style: italic;
        }

        .judul-halaman {
            text-align: center;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11pt;
            margin-top: 10px;
        }

        .sub-judul {
            text-align: center;
            font-size: 9pt;
            margin-bottom: 15px;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.4;
        }

        .info-pelatihan {
            margin-bottom: 12px;
            width: 100%;
            font-size: 10pt;
        }

        .info-pelatihan td {
            padding: 2px 0;
            vertical-align: top;
        }

        /* Tabel Utama Presensi */
        table.data-absensi {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        table.data-absensi th,
        table.data-absensi td {
            border: 1px solid #000;
            padding: 10px 4px;
            text-align: center;
            font-size: 9.5pt;
        }

        table.data-absensi th {
            background-color: #f2f2f2;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 9pt;
        }

        table.data-absensi td.nama {
            text-align: left;
            padding-left: 8px;
            text-transform: uppercase;
        }

        /* Kolom Tanda Tangan Zig-Zag */
        .ttd-kiri {
            text-align: left;
            font-size: 9pt;
            width: 100%;
            height: 25px;
            padding-left: 5px;
        }

        .ttd-kanan {
            text-align: left;
            font-size: 9pt;
            width: 100%;
            height: 25px;
            padding-left: 40px;
        }

        .cell-ttd {
            width: 100px;
            vertical-align: middle;
        }

        /* Susunan TTD Kabid */
        .footer-container {
            margin-top: 35px;
            width: 100%;
            font-size: 10pt;
        }

        .ttd-kabid {
            float: right;
            text-align: center;
            width: 300px;
        }

        .ttd-kabid .nama-pejabat {
            margin-top: 65px;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
        }
    </style>
</head>

<body>

    <table class="table-kop">
        <tr>
            <td class="cell-teks">
                <div class="container-logo">
                    <img src="{{ public_path('logos/disnaker.png') }}" alt="Logo Pemkab"
                        style="width: 70px; height: auto;">
                </div>

                <h2>Pemerintah Kabupaten Situbondo</h2>
                <h3>Dinas Ketenagakerjaan</h3>
                <p>Jl. PB. Sudirman No. 20 Karangasem, Patokan, Situbondo, Jawa Timur 68321</p>
                <p>Telepon (0338) 673204, Faksimile (0338) 673204</p>
                <p>Laman: https://disnaker.situbondokab.go.id, Pos-el disnakersitubondokab@gmail.com</p>
            </td>
        </tr>
    </table>

    <div class="judul-halaman">Daftar Hadir Peserta Pelatihan</div>
    <div class="sub-judul">
        Kegiatan Proses Pelaksanaan Pendidikan dan Pelatihan Keterampilan Kerja<br>
        Berdasarkan Klaster Kompetensi Dinas Ketenagakerjaan Kab. Situbondo
    </div>

    <table class="info-pelatihan">
        <tr>
            <td style="width: 20%;">Kejuruan / Pelatihan</td>
            <td style="width: 2%;">:</td>
            <td style="font-weight: bold; text-transform: uppercase;">{{ $pelatihan->nama_pelatihan }}</td>
        </tr>
        <tr>
            <td>Bulan / Tahun</td>
            <td>:</td>
            <td style="text-transform: uppercase;">{{ now()->translatedFormat('F Y') }}</td>
        </tr>
    </table>

    <table class="data-absensi">
        <thead>
            <tr>
                <th style="width: 6%;">No</th>
                <th style="width: 54%;">Nama Peserta</th>
                <th style="width: 40%;" colspan="2">Tanda Tangan / Paraf Fisik</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($peserta as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="nama">{{ $item->user->profil->nama_lengkap ?? $item->user->name }}</td>

                    <td class="cell-ttd">
                        @if (($index + 1) % 2 != 0)
                            <div class="ttd-kiri">{{ $index + 1 }}. ..........</div>
                        @else
                            &nbsp;
                        @endif
                    </td>

                    <td class="cell-ttd">
                        @if (($index + 1) % 2 == 0)
                            <div class="ttd-kanan">{{ $index + 1 }}. ..........</div>
                        @else
                            &nbsp;
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="padding: 20px; color: #666; font-style: italic; text-align: center;">
                        Belum ada data peserta yang lolos seleksi dan disetujui oleh Kepala Bidang.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer-container">
        <div class="ttd-kabid">
            <p>Situbondo, &nbsp;&nbsp;&nbsp; {{ now()->translatedFormat('F Y') }}</p>
            <p style="font-weight: bold; text-transform: uppercase; margin: 0;">
                Kepala Bidang Pelatihan Kerja<br>Produktivitas dan Transmigrasi
            </p>

            <p class="nama-pejabat">
                {{ $kabid?->profil?->nama_lengkap ?? ($kabid?->name ?? '.................................') }}</p>
            <p style="margin: 0;">NIP.
                {{ $kabid?->profil?->nip ?? ($kabid?->nomor_identitas ?? '.................................') }}</p>
        </div>
    </div>

</body>

</html>
