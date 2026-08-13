<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - SIM-PELJA</title>
</head>

<body
    style="
    margin: 0;
    padding: 0;
    background-color: #f3f4f6;
    font-family: Arial, Helvetica, sans-serif;
">

    <table width="100%" cellpadding="0" cellspacing="0" border="0"
        style="background-color: #f3f4f6; padding: 40px 15px;">

        <tr>
            <td align="center">

                <table width="600" cellpadding="0" cellspacing="0" border="0"
                    style="
                        max-width: 600px;
                        width: 100%;
                        background-color: #ffffff;
                        border-radius: 12px;
                        overflow: hidden;
                    ">

                    {{-- HEADER --}}
                    <tr>
                        <td align="center"
                            style="
                                padding: 35px 30px 25px;
                                background-color: #ffffff;
                            ">

                            <img src="{{ asset('images/disnaker.png') }}" alt="Dinas Ketenagakerjaan" width="90"
                                style="
                                    display: block;
                                    width: 90px;
                                    height: auto;
                                    margin: 0 auto 15px;
                                ">

                            <h1
                                style="
                                margin: 0;
                                color: #111827;
                                font-size: 24px;
                                font-weight: bold;
                            ">
                                SIM-PELJA
                            </h1>

                            <p
                                style="
                                margin: 8px 0 0;
                                color: #6b7280;
                                font-size: 13px;
                            ">
                                Sistem Informasi Manajemen Pelatihan Kerja
                            </p>

                        </td>
                    </tr>

                    {{-- CONTENT --}}
                    <tr>
                        <td style="padding: 10px 40px 35px;">

                            <h2
                                style="
                                margin: 0 0 20px;
                                color: #111827;
                                font-size: 20px;
                            ">
                                Verifikasi Alamat Email
                            </h2>

                            <p
                                style="
                                margin: 0 0 15px;
                                color: #374151;
                                font-size: 15px;
                                line-height: 1.7;
                            ">
                                Halo <strong>{{ $user->name }}</strong>,
                            </p>

                            <p
                                style="
                                margin: 0 0 15px;
                                color: #374151;
                                font-size: 15px;
                                line-height: 1.7;
                            ">
                                Terima kasih telah melakukan pendaftaran akun
                                pada <strong>SIM-PELJA</strong>.
                            </p>

                            <p
                                style="
                                margin: 0;
                                color: #374151;
                                font-size: 15px;
                                line-height: 1.7;
                            ">
                                Silakan verifikasi alamat email Anda dengan
                                menekan tombol di bawah ini untuk mengaktifkan
                                akun Anda.
                            </p>

                            {{-- BUTTON --}}
                            <table width="100%" cellpadding="0" cellspacing="0" border="0"
                                style="margin: 30px 0;">

                                <tr>
                                    <td align="center">

                                        <a href="{{ $url }}"
                                            style="
                                                display: inline-block;
                                                padding: 14px 30px;
                                                background-color: #2563eb;
                                                color: #ffffff;
                                                text-decoration: none;
                                                font-size: 15px;
                                                font-weight: bold;
                                                border-radius: 7px;
                                            ">
                                            Verifikasi Email Saya
                                        </a>

                                    </td>
                                </tr>

                            </table>

                            <p
                                style="
                                margin: 0 0 10px;
                                color: #6b7280;
                                font-size: 13px;
                                line-height: 1.6;
                            ">
                                Jika tombol di atas tidak dapat digunakan,
                                silakan salin dan buka tautan berikut pada
                                browser Anda:
                            </p>

                            <p
                                style="
                                margin: 0;
                                word-break: break-all;
                                font-size: 12px;
                                line-height: 1.6;
                            ">
                                <a href="{{ $url }}" style="color: #2563eb;">
                                    {{ $url }}
                                </a>
                            </p>

                            <hr
                                style="
                                border: 0;
                                border-top: 1px solid #e5e7eb;
                                margin: 30px 0;
                            ">

                            <p
                                style="
                                margin: 0;
                                color: #6b7280;
                                font-size: 12px;
                                line-height: 1.6;
                            ">
                                Jika Anda tidak merasa melakukan pendaftaran
                                akun ini, Anda dapat mengabaikan email ini.
                            </p>

                        </td>
                    </tr>

                    {{-- FOOTER --}}
                    <tr>
                        <td align="center"
                            style="
                                padding: 22px 30px;
                                background-color: #f9fafb;
                            ">

                            <p
                                style="
                                margin: 0;
                                color: #6b7280;
                                font-size: 12px;
                            ">
                                © {{ date('Y') }} SIM-PELJA
                            </p>

                            <p
                                style="
                                margin: 6px 0 0;
                                color: #9ca3af;
                                font-size: 12px;
                            ">
                                Dinas Ketenagakerjaan
                            </p>

                        </td>
                    </tr>

                </table>

            </td>
        </tr>

    </table>

</body>

</html>
