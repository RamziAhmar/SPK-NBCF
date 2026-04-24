<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function loginProses(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // karena kita pakai username (bukan email)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // redirect sesuai role
            if (Auth::user()->role == 'admin') {
                return redirect()->route('dashboard')->with('success', 'Login berhasil sebagai Admin');
            } else {
                return redirect()->route('dashboard')->with('success', 'Login berhasil sebagai User');
            }
        }

        return back()->withErrors([
            'login' => 'Username atau password salah',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout berhasil');
    }
}
