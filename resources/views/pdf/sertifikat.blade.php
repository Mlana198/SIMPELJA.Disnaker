<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>Sertifikat Resmi Disnaker Situbondo</title>

    <style>
        /* =========================================================
           PENGATURAN PDF
           SETIAP .page = 1 HALAMAN A4 LANDSCAPE
           297mm x 210mm
        ========================================================= */

        @page {
            size: 297mm 210mm;
            margin: 0;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;

            width: 297mm;
            height: 210mm;

            font-family: "Times New Roman", serif;
            color: #000;
        }

        body {
            margin: 0;
            padding: 0;
        }


        /* =========================================================
           SETIAP LEMBAR = 1 A4 LANDSCAPE
        ========================================================= */

        .page {
            position: relative;

            width: 297mm;
            height: 210mm;

            min-width: 297mm;
            max-width: 297mm;

            min-height: 210mm;
            max-height: 210mm;

            overflow: hidden;

            page-break-after: always;
            page-break-inside: avoid;
        }

        .page:last-child {
            page-break-after: auto;
        }


        /* =========================================================
           BACKGROUND
           UKURAN TETAP A4 LANDSCAPE
        ========================================================= */

        .background {
            position: absolute;

            top: 0;
            left: 0;

            width: 297mm;
            height: 210mm;

            z-index: 0;
        }

        .background img {
            display: block;

            width: 297mm;
            height: 210mm;
        }


        /* =========================================================
           =========================================================
           LEMBAR 1 - SERTIFIKAT
           =========================================================
           ========================================================= */

        .content-area {
            position: absolute;

            /*
             * Area kerja berada di dalam frame emas.
             *
             * A4:
             * 297mm x 210mm
             *
             * Konten:
             * kiri  = 28mm
             * kanan = 28mm
             * atas  = 21mm
             * bawah = 18mm
             */

            top: 21mm;
            left: 28mm;
            right: 28mm;
            bottom: 18mm;

            z-index: 2;
        }


        /* =========================================================
           HEADER
        ========================================================= */

        .header {
            width: 100%;

            border-bottom: 1px solid #000;

            padding-bottom: 3mm;

            margin-bottom: 5mm;
        }

        .header table {
            width: 100%;

            border-collapse: collapse;
        }

        .header td {
            vertical-align: middle;
        }


        /* =========================================================
           LOGO
        ========================================================= */

        .logo-cell {
            width: 32mm;

            padding-left: 3mm;
            padding-right: 2mm;
        }

        .logo {
            width: 18mm;
            height: auto;
        }


        /* =========================================================
           HEADER TEXT
        ========================================================= */

        .header-text {
            text-align: center;

            padding-right: 4mm;
        }

        .pemkab {
            font-size: 11pt;

            font-weight: bold;

            line-height: 1.1;
        }

        .dinas {
            margin-top: 1mm;

            font-size: 15pt;

            font-weight: bold;

            color: #143d8d;

            line-height: 1.1;

            letter-spacing: 0.4pt;
        }

        .alamat {
            margin-top: 1mm;

            font-size: 7pt;

            line-height: 1.3;
        }

        .empty-cell {
            width: 32mm;
        }


        /* =========================================================
           JUDUL SERTIFIKAT
        ========================================================= */

        .certificate-title {
            text-align: center;

            margin-top: 5mm;

            margin-bottom: 5mm;
        }

        .certificate-title h1 {
            margin: 0;

            font-size: 22pt;

            font-weight: bold;

            letter-spacing: 1.7pt;

            text-decoration: underline;
        }

        .nomor {
            margin-top: 2mm;

            font-size: 8pt;
        }


        /* =========================================================
           ISI SERTIFIKAT
        ========================================================= */

        .certificate-content {
            width: 100%;

            text-align: center;
        }

        .opening {
            width: 82%;

            margin: 0 auto;

            font-size: 8.5pt;

            line-height: 1.5;

            text-align: center;
        }


        /* =========================================================
           NAMA PESERTA
        ========================================================= */

        .nama-peserta {
            margin-top: 8mm;

            margin-bottom: 3mm;

            font-size: 25pt;

            font-weight: bold;

            font-style: italic;

            color: #143d8d;

            letter-spacing: 0.7pt;

            text-transform: uppercase;
        }


        /* =========================================================
           TELAH MENGIKUTI
        ========================================================= */

        .mengikuti {
            margin-bottom: 3mm;

            font-size: 8.5pt;

            letter-spacing: 1.7pt;

            text-transform: uppercase;
        }


        /* =========================================================
           NAMA PELATIHAN
        ========================================================= */

        .pelatihan {
            width: 80%;

            margin: 0 auto;

            font-size: 8.5pt;

            line-height: 1.55;

            text-align: center;
        }

        .pelatihan strong {
            color: #143d8d;

            font-size: 10pt;
        }


        /* =========================================================
           =========================================================
           FOOTER SERTIFIKAT
           =========================================================
           ========================================================= */

        .certificate-footer {
            position: absolute;

            left: 0;
            right: 0;

            bottom: 50mm;

            width: 100%;
        }

        .certificate-footer table {
            width: 100%;

            border-collapse: collapse;
        }

        .certificate-footer td {
            vertical-align: bottom;
        }


        /* =========================================================
           KETERANGAN
        ========================================================= */

        .note {
            width: 58%;

            margin-right: 40mm;
            padding-right: 15mm;
            padding-left: 25mm;
            padding-bottom: 4mm;

            font-size: 7pt;
            line-height: 1.4;

            color: #444;

            vertical-align: bottom;
        }


        /* =========================================================
           TANDA TANGAN
        ========================================================= */

        .signature {
            width: 82%;

            text-align: center;

            padding-bottom: 2mm;

            vertical-align: bottom;
        }

        .date {
            font-size: 7.5pt;

            margin-bottom: 1mm;
        }

        .position {
            font-size: 7.5pt;

            font-weight: bold;

            line-height: 1.2;

            text-transform: uppercase;
        }


        /* =========================================================
           QR CODE
        ========================================================= */

        .qr {
            margin: 1.2mm 0.2 1mm;
        }

        .qr img {
            width: 16mm;
            height: 16mm;
        }


        /* =========================================================
           NAMA PENANDATANGAN
        ========================================================= */

        .sign-name {
            font-size: 8pt;

            font-weight: bold;

            text-decoration: underline;

            text-transform: uppercase;
        }


        /* =========================================================
           NIP
        ========================================================= */

        .nip {
            margin-top: 0.4mm;

            font-size: 6.8pt;
        }


        /* =========================================================
           =========================================================
           LEMBAR 2 - HASIL PENILAIAN
           =========================================================
           ========================================================= */

        .score-content {
            position: absolute;

            /*
             * Area diperlebar agar isi tidak terlalu kecil
             * dan tetap berada di dalam frame emas.
             */

            top: 20mm;

            left: 27mm;

            right: 27mm;

            bottom: 20mm;

            z-index: 2;
        }


        /* =========================================================
           HEADER LEMBAR 2
        ========================================================= */

        .score-header {
            text-align: center;

            margin-bottom: 6mm;
        }

        .score-header .institution {
            font-size: 11pt;

            font-weight: bold;

            text-transform: uppercase;

            line-height: 1.1;
        }

        .score-header .department {
            margin-top: 1mm;

            font-size: 15pt;

            font-weight: bold;

            color: #143d8d;

            text-transform: uppercase;

            line-height: 1.1;
        }

        .score-header .document-title {
            margin-top: 4mm;

            font-size: 18pt;

            font-weight: bold;

            text-transform: uppercase;

            text-decoration: underline;

            letter-spacing: 0.9pt;
        }

        .score-header .subtitle {
            margin-top: 1.5mm;

            font-size: 8pt;
        }


        /* =========================================================
           IDENTITAS PESERTA
        ========================================================= */

        .identity {
            width: 88%;

            margin: 0 auto 5mm;
        }

        .identity-table {
            width: 100%;

            border-collapse: collapse;
        }

        .identity-table td {
            padding: 1.4mm 1mm;

            font-size: 8.5pt;

            vertical-align: top;
        }

        .identity-label {
            width: 35mm;

            font-weight: bold;
        }

        .identity-separator {
            width: 5mm;

            text-align: center;
        }

        .identity-value {
            width: auto;
        }


        /* =========================================================
           TABEL NILAI
        ========================================================= */

        .score-table {
            width: 88%;

            margin: 0 auto;

            border-collapse: collapse;

            font-size: 8.5pt;
        }

        .score-table th,
        .score-table td {
            border: 1px solid #000;

            padding: 2.8mm 2.5mm;
        }

        .score-table th {
            text-align: center;

            font-weight: bold;

            background-color: #e8edf5;

            font-size: 8pt;
        }

        .score-table td {
            vertical-align: middle;
        }


        /* =========================================================
           KOLOM TABEL
        ========================================================= */

        .col-no {
            width: 9%;

            text-align: center;
        }

        .col-component {
            width: 47%;
        }

        .col-score {
            width: 18%;

            text-align: center;

            font-weight: bold;
        }

        .col-predicate {
            width: 26%;

            text-align: center;

            font-weight: bold;
        }


        /* =========================================================
           KETERANGAN LEMBAR 2
        ========================================================= */

        .score-description {
            width: 88%;

            margin: 4mm auto 0;

            font-size: 7.5pt;

            line-height: 1.45;

            color: #333;

            text-align: left;
        }
    </style>

</head>


<body>


    <!-- =========================================================
         =========================================================
         LEMBAR 1 - SERTIFIKAT
         =========================================================
         ========================================================= -->

    <div class="page">


        <!-- =====================================================
             BACKGROUND LEMBAR 1
        ====================================================== -->

        <div class="background">

            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/background.png'))) }}"
                alt="Background Sertifikat">

        </div>


        <!-- =====================================================
             AREA KONTEN
        ====================================================== -->

        <div class="content-area">


            <!-- =================================================
                 HEADER
            ================================================== -->

            <div class="header">

                <table>

                    <tr>


                        <!-- LOGO -->

                        <td class="logo-cell">

                            <img class="logo" src="{{ public_path('images/disnaker.png') }}" alt="Logo Disnaker">

                        </td>


                        <!-- HEADER TEXT -->

                        <td class="header-text">

                            <div class="pemkab">

                                PEMERINTAH KABUPATEN SITUBONDO

                            </div>


                            <div class="dinas">

                                DINAS KETENAGAKERJAAN

                            </div>


                            <div class="alamat">

                                Jl. PB. Sudirman No. 01 Situbondo 68312

                                <br>

                                Telp. (0338) 673204 • Fax. (0338) 671728

                            </div>

                        </td>


                        <!-- RUANG KANAN -->

                        <td class="empty-cell"></td>


                    </tr>

                </table>

            </div>


            <!-- =================================================
                 JUDUL SERTIFIKAT
            ================================================== -->

            <div class="certificate-title">

                <h1>

                    SERTIFIKAT

                </h1>


                <div class="nomor">

                    Nomor :

                    <strong>

                        {{ $nomor_sertifikat }}

                    </strong>

                </div>

            </div>


            <!-- =================================================
                 ISI SERTIFIKAT
            ================================================== -->

            <div class="certificate-content">


                <!-- PEMBUKA -->

                <div class="opening">

                    Berdasarkan Keputusan Kepala Dinas Ketenagakerjaan
                    Kabupaten Situbondo Nomor

                    <strong>

                        {{ $nomor_sk_kadis ?? '188/087/431.306.2.1/2025' }}

                    </strong>

                    tanggal

                    {{ \Carbon\Carbon::parse($tanggal_sk_kadis)->translatedFormat('d F Y') }}

                    tentang Penunjukan Peserta Kegiatan Pelaksanaan Pendidikan
                    dan Pelatihan Keterampilan bagi Pencari Kerja di Kabupaten
                    Situbondo berdasarkan Klaster Kompetensi Tahun Anggaran

                    {{ date('Y', strtotime($tanggal_terbit ?? now())) }},

                    dengan ini diberikan sertifikat kepada:

                </div>


                <!-- NAMA PESERTA -->

                <div class="nama-peserta">

                    {{ strtoupper($nama_peserta) }}

                </div>


                <!-- TELAH MENGIKUTI -->

                <div class="mengikuti">

                    TELAH MENGIKUTI

                </div>


                <!-- NAMA PELATIHAN -->

                <div class="pelatihan">

                    <strong>

                        {{ strtoupper($nama_pelatihan) }}

                    </strong>

                    <br>
                    <br>

                    berdasarkan Unit Kompetensi selama

                    {{ $durasi_pelatihan ?? 0 }}

                    Hari yang diselenggarakan oleh Dinas Ketenagakerjaan
                    Kabupaten Situbondo bekerja sama dengan UPT Balai
                    Latihan Kerja Provinsi Jawa Timur di Situbondo.

                </div>

            </div>


            <!-- =================================================
                 FOOTER
            ================================================== -->

            <div class="certificate-footer">

                <table>

                    <tr>


                        <!-- =================================================
                             KETERANGAN
                        ================================================== -->

                        <td class="note">

                            <strong>

                                Keterangan:

                            </strong>

                            <br>

                            Sertifikat ini diterbitkan secara elektronik oleh

                            <strong>

                                Dinas Ketenagakerjaan Kabupaten Situbondo

                            </strong>.

                            <br>

                            Keaslian sertifikat dapat diverifikasi melalui
                            QR Code atau SIM-PELJA.

                        </td>


                        <!-- =================================================
                             TANDA TANGAN
                        ================================================== -->

                        <td class="signature">


                            <!-- TANGGAL -->

                            <div class="date">

                                Situbondo,

                                {{ \Carbon\Carbon::parse($tanggal_terbit)->translatedFormat('d F Y') }}

                            </div>


                            <!-- JABATAN -->

                            <div class="position">

                                Kepala Dinas Ketenagakerjaan

                                <br>

                                Kabupaten Situbondo

                            </div>


                            <!-- =================================================
                                 QR CODE
                            ================================================== -->

                            @php

                                $textQrSertifikat =
                                    "DOKUMEN SERTIFIKAT RESMI\n" .
                                    "Dinas Ketenagakerjaan Kabupaten Situbondo\n\n" .
                                    'Nomor Sertifikat: ' .
                                    $nomor_sertifikat .
                                    "\n" .
                                    'Nama Peserta: ' .
                                    strtoupper($nama_peserta) .
                                    "\n" .
                                    'Pelatihan: ' .
                                    strtoupper($nama_pelatihan) .
                                    "\n\n" .
                                    "Disahkan Secara Elektronik Oleh:\n" .
                                    "Jabatan: Kepala Dinas Ketenagakerjaan\n" .
                                    'Nama: ' .
                                    ($penandatangan_nama ?? 'KHOLIL, S.P., M.P.') .
                                    "\n" .
                                    'NIP: ' .
                                    ($penandatangan_nip ?? '19680516 199203 1 012') .
                                    "\n" .
                                    'Tanggal Terbit: ' .
                                    \Carbon\Carbon::parse($tanggal_terbit ?? now())->translatedFormat('d F Y');
                            @endphp


                            <div class="qr">

                                <img src="data:image/svg+xml;base64,{{ base64_encode(SimpleSoftwareIO\QrCode\Facades\QrCode::size(70)->margin(0)->generate($textQrSertifikat)) }}"
                                    alt="QR Code Sertifikat">

                            </div>


                            <!-- NAMA PENANDATANGAN -->

                            <div class="sign-name">

                                {{ $penandatangan_nama ?? 'KHOLIL, S.P., M.P.' }}

                            </div>


                            <!-- NIP -->

                            <div class="nip">

                                NIP.

                                {{ $penandatangan_nip ?? '19680516 199203 1 012' }}

                            </div>

                        </td>

                    </tr>

                </table>

            </div>

        </div>

    </div>



    <!-- =========================================================
         =========================================================
         LEMBAR 2 - HASIL PENILAIAN
         =========================================================
         ========================================================= -->

    <div class="page">


        <!-- =====================================================
             BACKGROUND LEMBAR 2
        ====================================================== -->

        <div class="background">

            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/background2.png'))) }}"
                alt="Background Lembar Hasil Penilaian">

        </div>


        <!-- =====================================================
             AREA KONTEN LEMBAR 2
        ====================================================== -->

        <div class="score-content">


            <!-- =================================================
                 HEADER
            ================================================== -->

            <div class="header">

                <table>

                    <tr>


                        <!-- LOGO -->

                        <td class="logo-cell">

                            <img class="logo" src="{{ public_path('images/disnaker.png') }}" alt="Logo Disnaker">

                        </td>


                        <!-- HEADER TEXT -->

                        <td class="header-text">

                            <div class="pemkab">

                                PEMERINTAH KABUPATEN SITUBONDO

                            </div>


                            <div class="dinas">

                                DINAS KETENAGAKERJAAN

                            </div>


                            <div class="alamat">

                                Jl. PB. Sudirman No. 01 Situbondo 68312

                                <br>

                                Telp. (0338) 673204 • Fax. (0338) 671728

                            </div>

                        </td>


                        <!-- RUANG KANAN -->

                        <td class="empty-cell"></td>


                    </tr>

                </table>

            </div>

            <div class="score-header">


                <div class="document-title">

                    LEMBAR HASIL PENILAIAN

                </div>


                <div class="subtitle">

                    Hasil Penilaian Peserta Pelatihan

                </div>

            </div>


            <!-- =================================================
                 IDENTITAS PESERTA
            ================================================== -->

            <div class="identity">

                <table class="identity-table">


                    <!-- NAMA -->

                    <tr>

                        <td class="identity-label">

                            Nama Peserta

                        </td>

                        <td class="identity-separator">

                            :

                        </td>

                        <td class="identity-value">

                            <strong>

                                {{ strtoupper($nama_peserta) }}

                            </strong>

                        </td>

                    </tr>


                    <!-- NIK -->

                    <tr>

                        <td class="identity-label">

                            NIK

                        </td>

                        <td class="identity-separator">

                            :

                        </td>

                        <td class="identity-value">

                            {{ $nik ?? '-' }}

                        </td>

                    </tr>


                    <!-- NOMOR SERTIFIKAT -->

                    <tr>

                        <td class="identity-label">

                            Nomor Sertifikat

                        </td>

                        <td class="identity-separator">

                            :

                        </td>

                        <td class="identity-value">

                            {{ $nomor_sertifikat }}

                        </td>

                    </tr>


                    <!-- PROGRAM PELATIHAN -->

                    <tr>

                        <td class="identity-label">

                            Program Pelatihan

                        </td>

                        <td class="identity-separator">

                            :

                        </td>

                        <td class="identity-value">

                            <strong>

                                {{ strtoupper($nama_pelatihan) }}

                            </strong>

                        </td>

                    </tr>


                    <!-- DURASI -->

                    <tr>

                        <td class="identity-label">

                            Durasi Pelatihan

                        </td>

                        <td class="identity-separator">

                            :

                        </td>

                        <td class="identity-value">

                            {{ $durasi_pelatihan ?? 0 }} Hari

                        </td>

                    </tr>

                </table>

            </div>


            <!-- =================================================
                 TABEL NILAI
            ================================================== -->

            <table class="score-table">


                <thead>

                    <tr>

                        <th class="col-no">

                            No.

                        </th>

                        <th class="col-component">

                            Komponen Penilaian

                        </th>

                        <th class="col-score">

                            Nilai

                        </th>

                        <th class="col-predicate">

                            Keterangan

                        </th>

                    </tr>

                </thead>


                <tbody>


                    <!-- =================================================
                         NILAI TEORI
                    ================================================== -->

                    <tr>

                        <td class="col-no">

                            1

                        </td>

                        <td>

                            Nilai Teori

                        </td>

                        <td class="col-score">

                            {{ number_format($nilai_teori ?? 0, 2, ',', '.') }}

                        </td>

                        <td class="col-predicate">

                            @if (($nilai_teori ?? 0) >= 70)
                                <span style="color:#0f766e;">

                                    LULUS

                                </span>
                            @else
                                <span style="color:#dc2626;">

                                    TIDAK LULUS

                                </span>
                            @endif

                        </td>

                    </tr>


                    <!-- =================================================
                         NILAI PRAKTIK
                    ================================================== -->

                    <tr>

                        <td class="col-no">

                            2

                        </td>

                        <td>

                            Nilai Praktik

                        </td>

                        <td class="col-score">

                            {{ number_format($nilai_praktek ?? 0, 2, ',', '.') }}

                        </td>

                        <td class="col-predicate">

                            @if (($nilai_praktek ?? 0) >= 70)
                                <span style="color:#0f766e;">

                                    LULUS

                                </span>
                            @else
                                <span style="color:#dc2626;">

                                    TIDAK LULUS

                                </span>
                            @endif

                        </td>

                    </tr>


                    <!-- =================================================
                         NILAI AKHIR
                    ================================================== -->

                    <tr>

                        <td class="col-no">

                            3

                        </td>

                        <td>

                            <strong>

                                Nilai Akhir

                            </strong>

                        </td>

                        <td class="col-score">

                            <strong>

                                {{ number_format($nilai_akhir ?? 0, 2, ',', '.') }}

                            </strong>

                        </td>

                        <td class="col-predicate">

                            @if (($status_nilai ?? '') === 'LULUS')
                                <span style="color:#0f766e;">

                                    LULUS

                                </span>
                            @else
                                <span style="color:#dc2626;">

                                    TIDAK LULUS

                                </span>
                            @endif

                        </td>

                    </tr>

                </tbody>

            </table>


            <!-- =================================================
                 KETERANGAN
            ================================================== -->

            <div class="score-description">

                <strong>

                    Keterangan:

                </strong>

                <br>

                Nilai akhir merupakan hasil penilaian peserta selama mengikuti
                kegiatan pelatihan.

                Peserta dinyatakan

                <strong>

                    {{ $status_nilai ?? 'TIDAK LULUS' }}

                </strong>

                berdasarkan batas nilai kelulusan yang telah ditetapkan.

            </div>


        </div>

    </div>

</body>

</html>
