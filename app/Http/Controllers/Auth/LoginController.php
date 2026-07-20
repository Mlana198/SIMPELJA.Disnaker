<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'identity' => 'required',
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = \App\Models\User::where('nomor_identitas', $request->identity)
            ->where('email', $request->email)
            ->first();

        if ($user && \Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
            \Illuminate\Support\Facades\Auth::login($user);
            $request->session()->regenerate();

            return match ($user->role) {
                'admin'          => redirect()->intended('/admin'),
                'kabid'          => redirect()->intended('/kabid'),
                'sub_koordinator' => redirect()->intended('/subkoordinator'),
                'instruktur'     => redirect()->intended('/instruktur'),
                'peserta'        => redirect()->intended('/peserta'),
                default          => redirect('/'),
            };
        }

        return back()->withErrors(['email' => 'Identitas atau Email tidak cocok.']);
    }
}
