<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan form login (Sesuai nama rute Anda: Route::get('/login'))
    public function login()
    {
        if (Auth::check()) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role === 'pegawai') {
                return redirect()->route('pegawai.dashboard');
            }
        }
        return view('auth.login');
    }

    // Memproses autentikasi akun (Sesuai nama rute Anda: Route::post('/login'))
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string', // Mendukung Input Email atau Nomor HP
            'password' => 'required|string',
        ]);

        // Cek login via database
        $loginField = filter_var($credentials['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'no_hp';
        
        $attemptCredentials = [
            $loginField => $credentials['email'],
            $password = $credentials['password'], // PHP 8+ shorthand is handled by laravel, let's keep it clean
            'password' => $credentials['password'],
            'status' => 'aktif', // Hanya user aktif yang bisa masuk sistem
        ];

        // Cek attempt
        // We clean up attemptCredentials to avoid duplicates
        $attemptCredentials = [
            $loginField => $credentials['email'],
            'password' => $credentials['password'],
            'status' => 'aktif',
        ];

        if (Auth::attempt($attemptCredentials)) {
            $request->session()->regenerate();
            
            // Pengalihan berdasarkan role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role === 'pegawai') {
                return redirect()->route('pegawai.dashboard');
            }
            
            return redirect()->route('login'); // fallback
        }

        return back()->withErrors([
            'email' => 'Email/Nomor HP atau Password salah.',
        ])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}