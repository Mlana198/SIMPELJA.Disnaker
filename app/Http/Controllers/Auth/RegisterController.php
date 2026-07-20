<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ProfilPengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nama_lengkap'    => 'required|string|max:255',
            'nomor_identitas' => 'required|unique:users,nomor_identitas',
            'email'           => 'required|email|unique:users,email',
            'password'        => 'required|min:8',
        ]);

        DB::transaction(function () use ($request) {

            $user = User::create([
                'nomor_identitas' => $request->nomor_identitas,
                'email'           => $request->email,
                'password'        => Hash::make($request->password),
                'role'            => 'peserta',
            ]);

            ProfilPengguna::create([
                'user_id'      => $user->id,
                'nama_lengkap' => $request->nama_lengkap,
            ]);

            Auth::login($user);
        });

        return redirect('/peserta');
    }
}
