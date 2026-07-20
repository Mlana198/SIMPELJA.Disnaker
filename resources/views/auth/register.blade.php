<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi SIM-PELJA</title>
    @vite('resources/css/app.css')
    <link rel="icon" href="{{ asset('logos/disnaker.png?v=1') }}">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-gray-100 font-sans text-gray-900">

    <div class="flex min-h-screen items-center justify-center p-4">
        <div class="w-full max-w-md rounded-xl bg-white p-8 shadow-lg ring-1 ring-gray-900/10">

            <div class="mb-8 text-center">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">Daftar Akun Baru</h2>
                <p class="mt-2 text-sm text-gray-600">Lengkapi data untuk akses SIM-PELJA</p>
            </div>

            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-50 text-red-600 text-sm rounded border border-red-200">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register.post') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-900">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required
                        class="mt-2 block w-full rounded-md border-gray-300 shadow-sm ring-1 ring-gray-300 py-1.5 px-3">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900">NIK / NIP</label>
                    <input type="text" name="nomor_identitas" value="{{ old('nomor_identitas') }}" required
                        class="mt-2 block w-full rounded-md border-gray-300 shadow-sm ring-1 ring-gray-300 py-1.5 px-3">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required
                        class="mt-2 block w-full rounded-md border-gray-300 shadow-sm ring-1 ring-gray-300 py-1.5 px-3">
                </div>

                <div x-data="{ show: false }">
                    <label class="block text-sm font-medium text-gray-900">Password</label>
                    <div class="relative mt-2">
                        <input :type="show ? 'text' : 'password'" name="password" required
                            class="block w-full rounded-md border-gray-300 shadow-sm ring-1 ring-gray-300 py-1.5 pl-3 pr-10 text-gray-900 focus:ring-2 focus:ring-blue-600">

                        <button type="button" @click="show = !show"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <svg x-show="show" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div x-data="{ show: false }">
                    <label class="block text-sm font-medium text-gray-900">Verifikasi Password</label>
                    <div class="relative mt-2">
                        <input :type="show ? 'text' : 'password'" name="password_confirmation" required
                            class="block w-full rounded-md border-gray-300 shadow-sm ring-1 ring-gray-300 py-1.5 pl-3 pr-10 text-gray-900 focus:ring-2 focus:ring-blue-600">

                        <button type="button" @click="show = !show"
                            class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700 focus:outline-none">
                            <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                            <svg x-show="show" x-cloak class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="submit"
                    class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">
                    Daftar Sekarang
                </button>
            </form>

            <p class="mt-6 text-center text-sm text-gray-500">
                Sudah punya akun? <a href="/login" class="font-semibold text-blue-600 hover:text-blue-500">Masuk di
                    sini</a>
            </p>
        </div>
    </div>
</body>

</html>
