<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Menampilkan form login (Sesuai nama rute Anda: Route::get('/login'))
    public function login()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::guard('pegawai')->check()) {
            return redirect()->route('pegawai.dashboard');
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

        $loginField = filter_var($credentials['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'no_hp';

        $attemptCredentials = [
            $loginField => $credentials['email'],
            'password' => $credentials['password'],
        ];

        // Attempt admin guard
        if (Auth::guard('admin')->attempt($attemptCredentials)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        // Attempt pegawai guard
        if (Auth::guard('pegawai')->attempt($attemptCredentials)) {
            $request->session()->regenerate();
            return redirect()->route('pegawai.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email/Nomor HP atau Password salah.',
        ])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        Auth::guard('pegawai')->logout();
        Auth::guard('pasien')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    // GET /forgot-password
    public function forgotPassword()
    {
        return view('auth.forgot-password');
    }

    // POST /forgot-password
    public function forgotPasswordSend(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
        ]);
        
        // Simpan email target ke session untuk visual demo
        session(['reset_email' => $request->email]);
        return redirect()->route('password.forgot.verify');
    }

    // GET /forgot-password/verify
    public function verifyOtp()
    {
        if (!session()->has('reset_email')) {
            return redirect()->route('password.forgot');
        }
        return view('auth.verify-otp');
    }

    // POST /forgot-password/verify
    public function verifyOtpCheck(Request $request)
    {
        $request->validate([
            'otp' => 'required|array|min:4',
            'otp.*' => 'required|numeric',
        ]);
        
        // Dummy verification, accept any code
        return redirect()->route('password.forgot.reset');
    }

    // GET /forgot-password/reset
    public function resetPassword()
    {
        if (!session()->has('reset_email')) {
            return redirect()->route('password.forgot');
        }
        return view('auth.reset-password');
    }

    // POST /forgot-password/reset
    public function resetPasswordSave(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Hapus session email
        session()->forget('reset_email');

        return redirect()->route('login')->with('success', 'Kata sandi berhasil disetel ulang. Silakan masuk kembali.');
    }
}