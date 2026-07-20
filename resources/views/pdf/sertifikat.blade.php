<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Sertifikat Resmi Disnaker Situbondo</title>

    <style>
        @page {
            size: legal landscape;
            margin: 0;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            font-family: "Times New Roman", serif;
            color: #000;
        }

        body {
            width: 100%;
            height: 100%;
        }

        .certificate {

            position: relative;
            width: 1008pt;
            height: 612pt;
            background-image: url("data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/background.png'))) }}");
            background-repeat: no-repeat;
            background-size: 100% 100%;
        }

        .wrapper {
            position: absolute;
            top: 28pt;
            left: 55pt;
            right: 55pt;
            bottom: 28pt;
        }

        .header {
            width: 100%;
            border-bottom: 2px double #000;
            padding-bottom: 8pt;
            margin-bottom: 16pt;
        }

        .header table {
            width: 100%;
            border-collapse: collapse;
        }

        .header td {
            vertical-align: middle;
        }

        .header::after {
            content: "";
            position: absolute;
            left: 85pt;
            right: 105pt;
            bottom: 0;
            border-bottom: 2px double #000;
        }

        .logo {
            width: 85pt;
        }

        .logo img {
            width: 68pt;
            height: auto;
        }

        .header-text {
            text-align: center;
            font-weight: bold;
        }

        .pemkab {
            font-size: 13pt;
            text-transform: uppercase;
            margin-bottom: 2pt;
        }

        .dinas {
            font-size: 20pt;
            font-weight: bold;
            text-transform: uppercase;
            color: #143d8d;
            letter-spacing: .6pt;
            margin-bottom: 3pt;
        }

        .alamat {
            font-size: 8pt;
            line-height: 1.4;
        }

        .title {
            text-align: center;
            margin-top: 10pt;
            margin-bottom: 12pt;
        }

        .title h1 {
            margin: 0;
            font-size: 24pt;
            font-weight: bold;
            letter-spacing: 2px;
            text-decoration: underline;
        }

        .nomor {
            margin-top: 5pt;
            font-size: 10pt;
        }

        .content {
            text-align: center;
            margin-top: 10pt;
        }

        .paragraph {
            width: 74%;
            margin: auto;
            font-size: 10.5pt;
            line-height: 1.55;
            text-align: center;
        }

        .nama-peserta {
            margin-top: 18pt;
            margin-bottom: 10pt;
            font-size: 30pt;
            font-weight: bold;
            font-style: italic;
            color: #143d8d;
            letter-spacing: .5pt;
            text-transform: uppercase;
        }

        .mengikuti {
            font-size: 11pt;
            font-weight: normal;
            letter-spacing: 1.5px;
            margin-bottom: 10pt;
            text-transform: uppercase;
        }

        .pelatihan {
            width: 70%;
            margin: auto;
            font-size: 10.5pt;
            line-height: 1.55;
            text-align: center;
        }

        .pelatihan strong {
            color: #143d8d;
        }

        .footer {
            margin-top: 22pt;
            width: 100%;
        }

        .footer table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .footer td {
            vertical-align: bottom;
        }

        .catatan {
            width: 95%;
            padding-left: 285pt;
            padding-right: 20pt;
            font-size: 8pt;
            line-height: 1.45;
            color: #444;
        }

        .ttd {
            width: 42%;
            text-align: center;
        }

        .tanggal {
            font-size: 10pt;
            margin-bottom: 5pt;
        }

        .jabatan {
            font-size: 10pt;
            font-weight: bold;
            line-height: 1.35;
            text-transform: uppercase;
        }

        .qr {
            margin: 12pt 0 8pt;
        }

        .qr img {
            width: 72px;
            height: 72px;
        }

        .nama-ttd {
            margin-top: 4pt;
            font-size: 11pt;
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
        }

        .nip {
            margin-top: 3pt;
            font-size: 9pt;
        }
    </style>

</head>

<body>
    <div class="certificate">
        <div class="wrapper">
            <div class="header">
                <table>
                    <tr>
                        <td class="logo">
                            <img src="{{ public_path('images/disnaker.png') }}">
                        </td>
                        <td class="header-text">
                            <div class="pemkab">
                                PEMERINTAH KABUPATEN SITUBONDO
                            </div>
                            <div class="dinas">
                                DINAS KETENAGAKERJAAN
                            </div>
                            <div class="alamat">
                                Jl. PB. Sudirman No. 01 Situbondo 68312<br>
                                Telp. (0338) 673204 • Fax. (0338) 671728
                            </div>
                        </td>
                        <td width="85"></td>
                    </tr>
                </table>
            </div>
            <div class="title">
                <h1>SERTIFIKAT</h1>
                <div class="nomor">
                    Nomor :
                    <strong>{{ $nomor_sertifikat }}</strong>
                </div>

            </div>
            <div class="content">
                <div class="paragraph">
                    Berdasarkan Keputusan Kepala Dinas Ketenagakerjaan Kabupaten Situbondo
                    Nomor
                    <strong>
                        {{ $nomor_sk_kadis ?? '188/087/431.306.2.1/2025' }}
                    </strong>
                    tanggal
                    {{ \Carbon\Carbon::parse($tanggal_sk_kadis)->translatedFormat('d F Y') }}
                    tentang Penunjukan Peserta Kegiatan Pelaksanaan Pendidikan dan
                    Pelatihan Keterampilan bagi Pencari Kerja di Kabupaten Situbondo
                    berdasarkan Klaster Kompetensi Tahun Anggaran {{ date('Y', strtotime($tanggal_terbit ?? now())) }},
                    dengan ini diberikan sertifikat kepada:
                </div>

                <div class="nama-peserta">
                    {{ strtoupper($nama_peserta) }}
                </div>

                <div class="mengikuti">
                    TELAH MENGIKUTI
                </div>

                <div class="pelatihan">
                    <strong>{{ strtoupper($nama_pelatihan) }}</strong>
                    <br><br>
                    berdasarkan Unit Kompetensi
                    selama
                    {{ $durasi_pelatihan ?? 0 }} Hari
                    yang diselenggarakan oleh Dinas Ketenagakerjaan Kabupaten Situbondo bekerja sama dengan UPT Balai
                    Latihan Kerja Provinsi Jawa Timur di Situbondo.
                </div>
                <br>
            </div>
            <div class="footer">
                <table>
                    <tr>
                        <td class="catatan">
                            <strong>Keterangan :</strong>
                            <br>
                            Sertifikat ini diterbitkan secara elektronik oleh
                            <strong>Dinas Ketenagakerjaan Kabupaten Situbondo</strong>.
                            <br>
                            Keaslian sertifikat dapat diverifikasi melalui QR Code atau SIM-PELJA.
                        </td>
                        <td class="ttd">
                            <div class="tanggal">
                                Situbondo,
                                {{ \Carbon\Carbon::parse($tanggal_terbit)->translatedFormat('d F Y') }}
                            </div>
                            <div class="jabatan">
                                Kepala Dinas Ketenagakerjaan
                                <br>
                                Kabupaten Situbondo
                            </div>
                            <div class="qr">
                                <img
                                    src="data:image/svg+xml;base64,{{ base64_encode(SimpleSoftwareIO\QrCode\Facades\QrCode::size(72)->margin(0)->generate(url('/sertifikat/verifikasi/' . $nomor_sertifikat))) }}">
                            </div>
                            <div class="nama-ttd">
                                {{ $penandatangan_nama ?? 'KHOLIL, S.P., M.P.' }}
                            </div>
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
</body>

</html>
