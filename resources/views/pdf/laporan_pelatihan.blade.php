<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Evaluasi dan Monitoring Pelatihan</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10pt;
            color: #000;
            margin: 0;
            padding: 10px;
            line-height: 1.4;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-kop {
            border-bottom: 3px double #000;
            margin-bottom: 18px;
            position: relative;
        }

        .table-kop td {
            border: none;
            padding: 0;
        }

        .container-logo {
            position: absolute;
            left: 15px;
            top: -5px;
        }

        .cell-teks {
            text-align: center;
            padding-bottom: 10px;
            padding-top: 5px;
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
            margin: 2px;
            font-size: 8.5pt;
        }

        .judul {
            margin-top: 10px;
            margin-bottom: 18px;
            text-align: center;
        }

        .judul h3 {
            margin: 0;
            font-size: 12pt;
            text-transform: uppercase;
        }

        .judul p {
            margin-top: 5px;
            font-size: 9pt;
            font-weight: bold;
        }

        .info {
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .info td {
            padding: 4px 0;
            vertical-align: top;
        }

        .section-title {
            margin-top: 15px;
            margin-bottom: 8px;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11pt;
        }

        .table-data {
            width: 100%;
            border-collapse: collapse;
        }

        .table-data th {
            background: #efefef;
            border: 1px solid #000;
            padding: 8px;
            font-size: 9pt;
        }

        .table-data td {
            border: 1px solid #000;
            padding: 7px;
            font-size: 9pt;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .no-break {
            page-break-inside: avoid;
            break-inside: avoid;
        }

        tr {
            page-break-inside: avoid;
            break-inside: avoid;
        }

        .footer-table {
            width: 100%;
            margin-top: 15px;
            border-collapse: collapse;
        }

        .footer-table td {
            border: none;
            vertical-align: top;
        }

        .ttd {
            width: 280px;
            float: right;
            text-align: center;
        }

        .nama-pejabat {
            margin-top: 70px;
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

                    <img src="{{ public_path('logos/disnaker.png') }}" width="70">

                </div>

                <h2>PEMERINTAH KABUPATEN SITUBONDO</h2>

                <h3>DINAS KETENAGAKERJAAN</h3>

                <p>
                    Jl. PB. Sudirman No.20 Karangasem,
                    Patokan, Situbondo, Jawa Timur 68321
                </p>

                <p>
                    Telepon (0338) 673204
                </p>

                <p>
                    https://disnaker.situbondokab.go.id
                </p>

            </td>

        </tr>

    </table>

    <div class="judul">

        <h3>
            LAPORAN EVALUASI DAN MONITORING PELATIHAN
        </h3>

        <p>

            PROGRAM PELATIHAN KERJA

            DINAS KETENAGAKERJAAN KABUPATEN SITUBONDO

        </p>

    </div>

    <table class="info">

        <tr>

            <td width="25%">
                Nama Pelatihan
            </td>

            <td width="2%">
                :
            </td>

            <td>

                <strong>

                    {{ $pelatihan->nama_pelatihan }}

                </strong>

            </td>

        </tr>

        <tr>

            <td>
                Periode Pelaksanaan
            </td>

            <td>:</td>

            <td>

                {{ \Carbon\Carbon::parse($pelatihan->tanggal_mulai)->translatedFormat('d F Y') }}

                s/d

                {{ \Carbon\Carbon::parse($pelatihan->tanggal_selesai)->translatedFormat('d F Y') }}

            </td>

        </tr>

        <tr>

            <td>
                Tanggal Dokumen
            </td>

            <td>:</td>

            <td>

                {{ now()->translatedFormat('d F Y') }}

            </td>

        </tr>

        <tr>

            <td>

                Jumlah Peserta

            </td>

            <td>

                :

            </td>

            <td>

                {{ $total_pendaftar }}

                Peserta

            </td>

        </tr>

    </table>

    <div class="section-title">

        A. RINGKASAN HASIL PELATIHAN

    </div>
    @php
        $persentaseKelulusan = $lolos_administrasi > 0 ? round(($total_lulus / $lolos_administrasi) * 100, 2) : 0;
    @endphp

    <table class="table-data">

        <thead>
            <tr>
                <th style="width:65%;">Indikator Evaluasi</th>
                <th style="width:35%;">Hasil</th>
            </tr>
        </thead>

        <tbody>

            <tr>
                <td>Total Pendaftar Pelatihan</td>
                <td class="text-center">
                    <strong>{{ $total_pendaftar }}</strong> Peserta
                </td>
            </tr>

            <tr>
                <td>Peserta Lolos Seleksi Administrasi</td>
                <td class="text-center">
                    <strong>{{ $lolos_administrasi }}</strong> Peserta
                </td>
            </tr>

            <tr>
                <td>Peserta Lolos Seleksi Wawancara</td>
                <td class="text-center">
                    <strong>{{ $lolos_interview }}</strong> Peserta
                </td>
            </tr>

            <tr>
                <td>Peserta Dinyatakan Lulus Pelatihan</td>
                <td class="text-center">
                    <strong>{{ $total_lulus }}</strong> Peserta
                </td>
            </tr>

            <tr>
                <td>Rata-Rata Nilai Akhir Peserta</td>
                <td class="text-center">
                    <strong>{{ number_format($rata_rata_nilai, 2) }}</strong>
                </td>
            </tr>

            <tr>
                <td>Persentase Kelulusan Peserta</td>
                <td class="text-center">
                    <strong>{{ $persentaseKelulusan }} %</strong>
                </td>
            </tr>

        </tbody>

    </table>

    <br>

    <table class="table-data">

        <thead>

            <tr>

                <th colspan="2">

                    KESIMPULAN HASIL PELATIHAN

                </th>

            </tr>

        </thead>

        <tbody>

            <tr>

                <td style="width:30%;">
                    Status Pelaksanaan
                </td>

                <td>

                    Pelatihan telah dilaksanakan sesuai jadwal yang telah
                    ditetapkan oleh Dinas Ketenagakerjaan Kabupaten Situbondo.

                </td>

            </tr>

            <tr>

                <td>

                    Hasil Pelaksanaan

                </td>

                <td>

                    Berdasarkan hasil evaluasi instruktur,
                    sebanyak

                    <strong>{{ $total_lulus }}</strong>

                    peserta dinyatakan memenuhi standar kompetensi
                    sesuai bidang pelatihan yang diikuti.

                </td>

            </tr>

            <tr>

                <td>

                    Tingkat Keberhasilan

                </td>

                <td>

                    Persentase keberhasilan pelatihan mencapai

                    <strong>{{ $persentaseKelulusan }}%</strong>

                    dari seluruh peserta yang mengikuti tahapan pelatihan.

                </td>

            </tr>

        </tbody>

    </table>

    <br>

    <div class="section-title">

        B. DAFTAR HASIL PENILAIAN PESERTA

    </div>
    <table class="table-data">

        <thead>

            <tr>

                <th style="width:5%;">No</th>

                <th style="width:28%;">Nama Peserta</th>

                <th style="width:22%;">NIK</th>

                <th style="width:12%;">Nilai Teori</th>

                <th style="width:12%;">Nilai Praktik</th>

                <th style="width:11%;">Nilai Akhir</th>

                <th style="width:10%;">Keterangan</th>

            </tr>

        </thead>

        <tbody>

            @forelse($peserta as $index => $item)
                @php

                    $nilai = $item->user->penilaians->first();

                    $nilaiTeori = $nilai->nilai_teori ?? 0;

                    $nilaiPraktek = $nilai->nilai_praktek ?? 0;

                    $nilaiAkhir = $nilai->nilai_akhir ?? 0;

                    $status = $nilaiAkhir >= 70 ? 'LULUS' : 'TIDAK LULUS';

                @endphp

                <tr>

                    <td class="text-center">

                        {{ $index + 1 }}

                    </td>

                    <td>

                        {{ strtoupper($item->user->profil->nama_lengkap ?? $item->user->name) }}

                    </td>

                    <td class="text-center">

                        {{ $item->user->nomor_identitas ?? '-' }}

                    </td>

                    <td class="text-center">

                        {{ number_format($nilaiTeori, 2) }}

                    </td>

                    <td class="text-center">

                        {{ number_format($nilaiPraktek, 2) }}

                    </td>

                    <td class="text-center">

                        <strong>

                            {{ number_format($nilaiAkhir, 2) }}

                        </strong>

                    </td>

                    <td class="text-center">

                        @if ($status == 'LULUS')
                            <strong style="color:#0f766e">

                                LULUS

                            </strong>
                        @else
                            <strong style="color:#dc2626">

                                TIDAK LULUS

                            </strong>
                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" style="text-align:center;
padding:20px;
font-style:italic;">

                        Belum terdapat data peserta yang dapat ditampilkan.

                    </td>

                </tr>
            @endforelse

        </tbody>

    </table>

    <br>

    <table class="table-data">

        <thead>

            <tr>

                <th colspan="2">

                    REKAPITULASI HASIL PENILAIAN

                </th>

            </tr>

        </thead>

        <tbody>

            <tr>

                <td style="width:35%;">

                    Jumlah Peserta

                </td>

                <td>

                    {{ $peserta->count() }} Orang

                </td>

            </tr>

            <tr>

                <td>

                    Peserta Lulus

                </td>

                <td>

                    {{ $total_lulus }} Orang

                </td>

            </tr>

            <tr>

                <td>

                    Peserta Tidak Lulus

                </td>

                <td>

                    {{ $peserta->count() - $total_lulus }} Orang

                </td>

            </tr>

            <tr>

                <td>

                    Rata-Rata Nilai Akhir

                </td>

                <td>

                    {{ number_format($rata_rata_nilai, 2) }}

                </td>

            </tr>

        </tbody>

    </table>

    <br>

    <div class="no-break">
        <div class="section-title">
            C. PENGESAHAN LAPORAN
        </div>

        <table style="width:100%; margin-top:10px; border-collapse:collapse;">
            <tr>
                <td style="text-align: justify; line-height: 1.7; text-indent: 40px; font-size: 10pt;">
                    Berdasarkan hasil pelaksanaan pelatihan, proses evaluasi, serta hasil penilaian peserta sebagaimana
                    diuraikan dalam laporan ini, maka kegiatan pelatihan dinyatakan telah dilaksanakan sesuai dengan
                    ketentuan yang berlaku. Laporan ini disusun sebagai bentuk pertanggungjawaban pelaksanaan kegiatan
                    pelatihan kerja pada Dinas Ketenagakerjaan Kabupaten Situbondo dan digunakan sebagai dasar dalam
                    penetapan kelulusan peserta pelatihan.
                </td>
            </tr>
        </table>

        <table class="footer-table">
            <tr>
                <td width="45%"></td>
                <td width="55%" style="text-align: center;">
                    <p style="margin-bottom: 5px;">
                        Situbondo, {{ now()->translatedFormat('d F Y') }}
                    </p>
                    <p style="margin: 0; font-weight: bold; text-transform: uppercase;">
                        KEPALA BIDANG PELATIHAN KERJA<br>
                        PRODUKTIVITAS DAN TRANSMIGRASI
                    </p>

                    <div style="margin: 8px 0;">
                        @php
                            $namaKabid =
                                $kabid?->profil?->nama_lengkap ?? ($kabid?->name ?? '................................');
                            $nipKabid = $kabid?->nomor_identitas ?? '................................';
                            $judulPelatihan = $pelatihan->nama_pelatihan ?? ($pelatihan->judul ?? 'Pelatihan Kerja');

                            $textQrLaporan =
                                "PENGESAHAN LAPORAN EVALUASI\n" .
                                "Dinas Ketenagakerjaan Kabupaten Situbondo\n\n" .
                                'Kegiatan: ' .
                                strtoupper($judulPelatihan) .
                                "\n" .
                                "Status: Disahkan & Dinyatakan Valid\n\n" .
                                "Disahkan Oleh:\n" .
                                "Jabatan: Kabid Pelatihan Kerja, Produktivitas dan Transmigrasi\n" .
                                'Nama: ' .
                                strtoupper($namaKabid) .
                                "\n" .
                                'NIP: ' .
                                $nipKabid .
                                "\n" .
                                'Tanggal Pengesahan: ' .
                                now()->translatedFormat('d F Y');
                        @endphp

                        <img src="data:image/svg+xml;base64,{{ base64_encode(SimpleSoftwareIO\QrCode\Facades\QrCode::size(80)->margin(0)->generate($textQrLaporan)) }}"
                            width="80" height="80" alt="QR Pengesahan">
                    </div>

                    <p class="nama-pejabat"
                        style="margin-top: 0; font-weight: bold; text-decoration: underline; text-transform: uppercase;">
                        {{ strtoupper($kabid?->profil?->nama_lengkap ?? ($kabid?->name ?? '................................')) }}
                    </p>
                    <p style="margin: 0; font-size: 9pt;">
                        NIP. {{ $kabid?->nomor_identitas ?? '................................' }}
                    </p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
