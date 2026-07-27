<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran SIM-PELJA</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
            color: #333;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px double #000;
            padding-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            text-transform: uppercase;
        }

        .header p {
            margin: 5px 0 0 0;
            color: #666;
        }

        .status-box {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 15px;
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            margin-bottom: 30px;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        table td {
            padding: 10px;
            vertical-align: top;
        }

        table td.label {
            width: 30%;
            font-weight: bold;
            color: #555;
        }

        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 12px;
            color: #888;
            border-top: 1px dashed #ccc;
            padding-top: 15px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Bukti Pendaftaran</h2>
        <p>Sistem Informasi Manajemen Pelatihan Kerja (SIM-PELJA)</p>
    </div>

    <div class="status-box">
        STATUS: LOLOS SELEKSI ADMINISTRASI
    </div>

    <table>
        <tr>
            <td class="label">Nomor Pendaftaran</td>
            <td style="font-weight: bold; color: #1e3a8a;">:
                {{ $pendaftaran->buktiPendaftaran->nomor_registrasi ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Nama Peserta</td>
            <td>: {{ $pendaftaran->user->profil->nama_lengkap ?? $pendaftaran->user->name }}</td>
        </tr>
        <tr>
            <td class="label">Nomor Identitas</td>
            <td>: {{ $pendaftaran->user->nomor_identitas ?? $pendaftaran->user->name }}</td>
        </tr>
        <tr>
            <td class="label">Program Pelatihan</td>
            <td>: {{ $pendaftaran->pelatihan->nama_pelatihan ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Daftar</td>
            <td>: {{ \Carbon\Carbon::parse($pendaftaran->tanggal_daftar)->translatedFormat('d F Y') }}</td>
        </tr>
    </table>

    <div class="footer">
        <p>Dokumen ini diterbitkan secara sah oleh sistem SIM-PELJA pada {{ now()->translatedFormat('d F Y H:i') }} WIB.
        </p>
        <p>Silakan bawa bukti cetak PDF ini saat melakukan proses Interview di pusat pelatihan.</p>
    </div>

</body>

</html>
