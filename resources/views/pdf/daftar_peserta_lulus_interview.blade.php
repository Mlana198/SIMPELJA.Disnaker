<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
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
            width: 100%;
            margin-bottom: 15px;
            font-size: 10pt;
        }

        .info-pelatihan td {
            padding: 3px 0;
        }

        .data-peserta {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
        }

        .data-peserta th,
        .data-peserta td {
            border: 1px solid #000;
            padding: 6px;
        }

        .data-peserta th {
            background: #f2f2f2;
            text-align: center;
        }

        .data-peserta td.nama {
            text-transform: uppercase;
        }

        .footer-container {
            margin-top: 40px;
        }

        .ttd-kabid {
            width: 300px;
            float: right;
            text-align: center;
        }

        .nama-pejabat {
            margin-top: 70px;
            text-decoration: underline;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <table class="table-kop">

        <tr>

            <td class="cell-teks">

                <div class="container-logo">

                    <img src="{{ public_path('logos/disnaker.png') }}" style="width:70px; height:auto;">

                </div>

                <h2>PEMERINTAH KABUPATEN SITUBONDO</h2>

                <h3>DINAS KETENAGAKERJAAN</h3>

                <p>
                    Jl. PB. Sudirman No. 20 Karangasem,
                    Patokan, Situbondo, Jawa Timur 68321
                </p>

                <p>
                    Telepon (0338) 673204,
                    Faksimile (0338) 673204
                </p>

                <p>
                    Laman:
                    https://disnaker.situbondokab.go.id,
                    Pos-el:
                    disnakersitubondokab@gmail.com
                </p>

            </td>

        </tr>

    </table>
    <div class="judul-halaman">

        DAFTAR PESERTA LULUS SELEKSI WAWANCARA

    </div>

    <div class="sub-judul">

        KEGIATAN PROSES PELAKSANAAN PENDIDIKAN DAN PELATIHAN
        KETERAMPILAN KERJA<br>

        BERDASARKAN KLASTER KOMPETENSI
        DINAS KETENAGAKERJAAN
        KABUPATEN SITUBONDO

    </div>

    <table class="info-pelatihan">

        <tr>

            <td style="width:22%">
                Pelatihan
            </td>

            <td style="width:2%">
                :
            </td>

            <td style="font-weight:bold">
                {{ strtoupper($pelatihan->nama_pelatihan) }}
            </td>

        </tr>

        <tr>

            <td>
                Tanggal
            </td>

            <td>
                :
            </td>

            <td>
                {{ \Carbon\Carbon::parse($pelatihan->tanggal_mulai)->translatedFormat('d F Y') }}
                s/d
                {{ \Carbon\Carbon::parse($pelatihan->tanggal_selesai)->translatedFormat('d F Y') }}
            </td>

        </tr>

        <tr>

            <td>
                Tanggal Cetak
            </td>

            <td>
                :
            </td>

            <td>
                {{ now()->translatedFormat('d F Y') }}
            </td>

        </tr>

    </table>
    <table class="data-peserta">

        <thead>

            <tr>

                <th style="width:5%">No</th>

                <th style="width:30%">
                    Nama Peserta
                </th>

                <th style="width:18%">
                    NIK
                </th>

                <th style="width:10%">
                    JK
                </th>

                <th style="width:22%">
                    Tempat, Tgl Lahir
                </th>

                <th style="width:15%">
                    Status
                </th>

            </tr>

        </thead>

        <tbody>

            @foreach ($peserta as $item)
                <tr>

                    <td align="center">
                        {{ $loop->iteration }}
                    </td>

                    <td class="nama">

                        {{ strtoupper($item->jadwalInterview->pendaftaran->user->profil->nama_lengkap ?? $item->jadwalInterview->pendaftaran->user->name) }}

                    </td>

                    <td align="center">

                        {{ $item->jadwalInterview->pendaftaran->user->nomor_identitas }}

                    </td>

                    <td align="center">

                        {{ $item->jadwalInterview->pendaftaran->user->profil->gender == 'L' ? 'L' : 'P' }}

                    </td>

                    <td>

                        {{ strtoupper($item->jadwalInterview->pendaftaran->user->profil->tempat_lahir) }},
                        {{ \Carbon\Carbon::parse($item->jadwalInterview->pendaftaran->user->profil->tanggal_lahir)->format('d-m-Y') }}

                    </td>

                    <td align="center">

                        {{ strtoupper($item->status_akhir) }}

                    </td>

                </tr>
            @endforeach

        </tbody>

    </table>
    <div class="footer-container">

        <div class="ttd-kabid">

            <p>
                Situbondo,
                {{ now()->translatedFormat('d F Y') }}
            </p>

            <p style="font-weight:bold">

                KEPALA BIDANG PELATIHAN KERJA<br>
                PRODUKTIVITAS DAN TRANSMIGRASI

            </p>

            <br><br>

            <p class="nama-pejabat">

                {{ strtoupper($kabid->profil->nama_lengkap ?? '-') }}

            </p>

            <p>

                NIP.
                {{ $kabid->nomor_identitas }}

            </p>

        </div>

    </div>
</body>

</html>
