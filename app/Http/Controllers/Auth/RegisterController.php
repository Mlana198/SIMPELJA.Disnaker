<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ProfilPengguna;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate(
            [
                'nama_lengkap' => [
                    'required',
                    'string',
                    'max:100',
                ],

                'nomor_identitas' => [
                    'required',
                    'string',
                    'max:18',
                    'unique:users,nomor_identitas',
                ],

                'email' => [
                    'required',
                    'email',
                    'max:100',
                    'unique:users,email',
                ],

                'password' => [
                    'required',
                    'min:8',
                    'confirmed',
                ],
            ],
            [
                'nomor_identitas.unique' =>
                'Nomor identitas tersebut sudah digunakan oleh akun lain.',

                'email.unique' =>
                'Email tersebut sudah digunakan oleh akun lain.',

                'nomor_identitas.required' =>
                'Nomor identitas wajib diisi.',

                'email.required' =>
                'Email wajib diisi.',

                'email.email' =>
                'Format email tidak valid.',

                'password.min' =>
                'Password minimal harus terdiri dari 8 karakter.',

                'password.confirmed' =>
                'Konfirmasi password tidak sesuai.',
            ]
        );

        $user = DB::transaction(function () use ($request) {

            $user = User::create([
                'nomor_identitas' => $request->nomor_identitas,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'peserta',
            ]);

            ProfilPengguna::create([
                'user_id' => $user->id,
                'nama_lengkap' => $request->nama_lengkap,
            ]);

            return $user;
        });

        Auth::login($user);

        $user->sendEmailVerificationNotification();

        return redirect()->route('verification.notice');
    }
}
