<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
    <link rel="icon" href="{{ asset('logos/disnaker.png?v=1') }}">

    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-gray-100 flex items-center justify-center p-4">

    <div class="w-full max-w-md rounded-xl bg-white p-8 shadow-lg text-center">

        <h1 class="text-2xl font-bold text-gray-900">
            Verifikasi Email
        </h1>

        <p class="mt-3 text-sm text-gray-600">
            Kami telah mengirimkan tautan verifikasi ke alamat email Anda.
        </p>

        <p class="mt-2 text-sm text-gray-600">
            Silakan buka email tersebut dan klik tombol verifikasi untuk mengaktifkan akun Anda.
        </p>

        @if (session('status') === 'verification-link-sent')
            <div class="mt-4 rounded-md bg-green-50 p-3 text-sm text-green-700">
                Tautan verifikasi baru telah dikirim ke email Anda.
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}" class="mt-6">
            @csrf

            <button type="submit"
                class="w-full rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-500">
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="mt-3">
            @csrf

            <button type="submit" class="text-sm text-gray-500 hover:text-gray-700">
                Keluar
            </button>
        </form>

    </div>

</body>

</html>
