<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\Poliklinik;
use App\Models\JadwalDokter;
use App\Models\Pendaftaran;
use App\Models\Antrean;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PasienAuthController extends Controller
{
    // Halaman Beranda Utama Pasien (daftarklinik.test)
    public function home()
    {
        return view('welcome');
    }

    // Halaman Layanan Klinik (Daftar Poli)
    public function layanan()
    {
        return view('frontend.layanan.index');
    }

    // Halaman Detail Poli Umum
    public function layananUmum()
    {
        return view('frontend.layanan.umum');
    }

    // Halaman Cara Daftar
    public function caraDaftar()
    {
        return view('frontend.cara_daftar');
    }

    // Halaman Tentang Klinik
    public function tentangKlinik()
    {
        return view('frontend.tentang_klinik');
    }

    // Halaman Tips Kesehatan (Daftar Artikel)
    public function tipsKesehatan()
    {
        return view('frontend.tips_kesehatan.index');
    }

    // Halaman Detail Artikel Begadang
    public function tipsKesehatanBegadang()
    {
        return view('frontend.tips_kesehatan.detail');
    }

    // Halaman Jadwal Dokter
    public function jadwalDokter()
    {
        $schedules = \App\Models\JadwalDokter::with('dokter.poliklinik')
            ->orderBy('tanggal', 'asc')
            ->orderBy('jam_mulai', 'asc')
            ->get();

        // Ambil list tanggal unik
        $dates = $schedules->pluck('tanggal')
            ->map(function($date) {
                return $date->format('Y-m-d');
            })
            ->unique()
            ->values()
            ->map(function($dateStr) {
                return \Carbon\Carbon::parse($dateStr);
            });

        // Group schedules by Y-m-d
        $groupedSchedules = $schedules->groupBy(function($schedule) {
            return $schedule->tanggal->format('Y-m-d');
        });

        return view('frontend.jadwal.index', compact('dates', 'groupedSchedules'));
    }

    // Halaman Landing/Welcome Entry (memiliki tombol Daftar & Masuk)
    public function welcome()
    {
        if (Auth::guard('pasien')->check()) {
            return redirect()->route('pasien.dashboard');
        }
        return view('frontend.auth.welcome_entry');
    }

    // Form Login Pasien (Mockup 3)
    public function loginForm()
    {
        if (Auth::guard('pasien')->check()) {
            return redirect()->route('pasien.dashboard');
        }
        return view('frontend.auth.login');
    }

    // Aksi Login Pasien
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email_phone' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginField = filter_var($credentials['email_phone'], FILTER_VALIDATE_EMAIL) ? 'email' : 'no_hp';

        $attemptCredentials = [
            $loginField => $credentials['email_phone'],
            'password' => $credentials['password'],
        ];

        if (Auth::guard('pasien')->attempt($attemptCredentials)) {
            $request->session()->regenerate();
            return redirect()->route('pasien.dashboard')->with('success', 'Berhasil masuk ke portal pasien.');
        }

        return back()->withErrors([
            'email_phone' => 'Email/Nomor HP atau Password salah.',
        ])->onlyInput('email_phone');
    }

    // Form Registrasi Pasien (Mockup 2)
    public function registerForm()
    {
        if (Auth::guard('pasien')->check()) {
            return redirect()->route('pasien.dashboard');
        }
        return view('frontend.auth.register');
    }

    // Aksi Registrasi Pasien
    public function register(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|size:16|unique:pasiens,nik',
            'email_phone' => 'required|string',
            'nama' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Generasi id_pasien sekuensial (format: PAS009)
        $latest = Pasien::orderBy('id_pasien', 'desc')->first();
        $num = 1;
        if ($latest) {
            $num = ((int) substr($latest->id_pasien, 3)) + 1;
        }
        $newId = 'PAS' . str_pad($num, 3, '0', STR_PAD_LEFT);

        // Identifikasi & set data inputan tunggal Email/Nomor Hp
        $email = null;
        $no_hp = null;
        $input = $request->email_phone;

        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            $email = $input;
            // no_hp wajib di database, gunakan digit unik dari NIK agar aman (max 13 char)
            $no_hp = '08' . substr($request->nik, 5, 11);
        } else {
            // Bersihkan input no hp
            $no_hp = substr(preg_replace('/[^0-9]/', '', $input), 0, 13);
            if (empty($no_hp)) {
                $no_hp = '08' . substr($request->nik, 5, 11);
            }
            // email wajib di database, gunakan NIK agar unik dan aman
            $email = $request->nik . '@gmail.com';
        }

        // Validasi keunikan email hasil parsing (jika input bertipe no_hp sehingga email di-generate otomatis)
        if (Pasien::where('email', $email)->exists()) {
            return back()->withErrors(['email_phone' => 'Email/Nomor HP sudah terdaftar.'])->withInput();
        }
        
        // Validasi keunikan no_hp hasil parsing
        if (Pasien::where('no_hp', $no_hp)->exists()) {
            return back()->withErrors(['email_phone' => 'Nomor HP sudah terdaftar.'])->withInput();
        }

        Pasien::create([
            'id_pasien' => $newId,
            'nik' => $request->nik,
            'email' => $email,
            'password' => $request->password, // Password akan di-hash otomatis via model casts 'hashed'
            'nama' => $request->nama,
            'jenis_kelamin' => 'Laki-laki', // Default karena kolom wajib di DB dan tidak ada di form mockup
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_hp' => $no_hp,
            'alamat' => null,
            'foto' => null,
        ]);

        return redirect()->route('pasien.login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Dashboard Pasien
    public function dashboard()
    {
        $pasien = Auth::guard('pasien')->user();
        $polikliniks = Poliklinik::all();
        $pendaftarans = Pendaftaran::where('id_user', $pasien->id_pasien)
            ->with('jadwalDokter.dokter.poliklinik', 'antrean')
            ->get()
            ->sortByDesc('created_at');

        // Fetch all queues in the database sequentially
        $allAntreans = Antrean::with('pendaftaran.pasien', 'pendaftaran.jadwalDokter.dokter.poliklinik')
            ->orderBy('id_antrean', 'asc')
            ->get();

        // Fetch called queues ('Dipanggil')
        $calledAntreans = Antrean::where('status_antrean', 'Dipanggil')
            ->with('pendaftaran.pasien', 'pendaftaran.jadwalDokter.dokter.poliklinik')
            ->orderBy('waktu_antrean', 'asc')
            ->get();

        // Fetch current patient's latest queue registration
        $myLatestAntrean = Antrean::whereHas('pendaftaran', function($q) use ($pasien) {
                $q->where('id_user', $pasien->id_pasien);
            })
            ->with('pendaftaran.jadwalDokter.dokter.poliklinik')
            ->orderBy('created_at', 'desc')
            ->orderBy('id_antrean', 'desc')
            ->first();

        // Calculate dynamic estimated waiting time
        $estimatedWaitTime = '';
        if ($myLatestAntrean) {
            $status = $myLatestAntrean->status_antrean;
            if ($status === 'Selesai') {
                $estimatedWaitTime = 'Selesai diperiksa';
            } elseif ($status === 'Dipanggil') {
                $estimatedWaitTime = 'Sedang dipanggil / diperiksa';
            } else {
                // Menunggu
                $dokter = $myLatestAntrean->pendaftaran->jadwalDokter->dokter()->first();
                $poliId = $dokter ? $dokter->id_poli : null;
                $myId = $myLatestAntrean->id_antrean;
                $aheadCount = Antrean::where('status_antrean', '!=', 'Selesai')
                    ->where('id_antrean', '<', $myId)
                    ->whereHas('pendaftaran.jadwalDokter.dokter', function($q) use ($poliId) {
                        $q->where('id_poli', $poliId);
                    })
                    ->count();

                $minutes = ($aheadCount + 1) * 15;
                $estimatedWaitTime = $minutes . ' menit lagi';
            }
        }

        // Fetch completed pendaftarans (status = 'Selesai')
        $completedPendaftarans = Pendaftaran::where('id_user', $pasien->id_pasien)
            ->where('status', 'Selesai')
            ->with('jadwalDokter.dokter.poliklinik', 'antrean')
            ->get()
            ->sortByDesc('created_at');

        return view('frontend.dashboard', compact('pasien', 'polikliniks', 'pendaftarans', 'allAntreans', 'calledAntreans', 'myLatestAntrean', 'estimatedWaitTime', 'completedPendaftarans'));
    }

    // Logout Pasien
    public function logout(Request $request)
    {
        Auth::guard('pasien')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('pasien.home');
    }

    // Halaman Lupa Password Pasien (GET /pasien/forgot-password)
    public function forgotPassword()
    {
        if (Auth::guard('pasien')->check()) {
            return redirect()->route('pasien.dashboard');
        }
        return view('frontend.auth.forgot-password');
    }

    // Mengirim Kode Lupa Password (POST /pasien/forgot-password)
    public function forgotPasswordSend(Request $request)
    {
        $request->validate([
            'email_phone' => 'required|string',
        ]);

        // Simpan ke session untuk visual demo
        session(['pasien_reset_email_phone' => $request->email_phone]);

        return redirect()->route('pasien.password.forgot.verify');
    }

    // Halaman Verifikasi OTP Pasien (GET /pasien/forgot-password/verify)
    public function verifyOtp()
    {
        if (!session()->has('pasien_reset_email_phone')) {
            return redirect()->route('pasien.password.forgot');
        }
        return view('frontend.auth.verify-otp');
    }

    // Memproses Verifikasi OTP Pasien (POST /pasien/forgot-password/verify)
    public function verifyOtpCheck(Request $request)
    {
        if (!session()->has('pasien_reset_email_phone')) {
            return redirect()->route('pasien.password.forgot');
        }

        // OTP minimal ada beberapa digit/dummy check, tidak dibatasi ketat agar user mudah mencoba
        return redirect()->route('pasien.password.forgot.reset');
    }

    // Halaman Buat Password Baru Pasien (GET /pasien/forgot-password/reset)
    public function resetPassword()
    {
        if (!session()->has('pasien_reset_email_phone')) {
            return redirect()->route('pasien.password.forgot');
        }
        return view('frontend.auth.reset-password');
    }

    // Menyimpan Password Baru Pasien (POST /pasien/forgot-password/reset)
    public function resetPasswordSave(Request $request)
    {
        if (!session()->has('pasien_reset_email_phone')) {
            return redirect()->route('pasien.password.forgot');
        }

        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Flow dummy: Cari pasien berdasarkan email/no_hp (jika ada di database) dan update passwordnya
        $emailOrPhone = session('pasien_reset_email_phone');
        $pasien = Pasien::where('email', $emailOrPhone)
            ->orWhere('no_hp', $emailOrPhone)
            ->first();

        if ($pasien) {
            $pasien->password = $request->password;
            $pasien->save();
        }

        // Hapus session setelah berhasil reset
        session()->forget('pasien_reset_email_phone');

        return redirect()->route('pasien.login')->with('success', 'Kata sandi berhasil disetel ulang. Silakan masuk kembali.');
    }

    // Mengambil jadwal dokter berdasarkan poli & tanggal via AJAX (GET /pasien/get-schedules)
    public function getSchedules(Request $request)
    {
        $id_poli = $request->id_poli;
        $tanggal = $request->tanggal;

        $query = JadwalDokter::with('dokter.poliklinik')
            ->whereHas('dokter', function ($q) use ($id_poli) {
                $q->where('id_poli', $id_poli);
            });

        $schedules = $query->get();

        if ($tanggal) {
            $targetDayOfWeek = \Carbon\Carbon::parse($tanggal)->dayOfWeekIso;
            $schedules = $schedules->filter(function ($s) use ($targetDayOfWeek) {
                return $s->tanggal->dayOfWeekIso === $targetDayOfWeek;
            });
        }

        $data = $schedules->map(function ($s) use ($tanggal) {
            $displayDate = $tanggal ? \Carbon\Carbon::parse($tanggal) : $s->tanggal;
            return [
                'id_jadwal' => $s->id_jadwal,
                'nama_dokter' => $s->dokter,
                'jam_mulai' => date('H:i', strtotime($s->jam_mulai)),
                'jam_selesai' => date('H:i', strtotime($s->jam_selesai)),
                'tanggal' => $displayDate->format('Y-m-d'),
                'tanggal_formatted' => $displayDate->format('d-m-Y'),
                'hari' => $s->hari,
            ];
        })->values();

        return response()->json($data);
    }

    // Menyimpan pendaftaran antrean baru (POST /pasien/pendaftaran/simpan)
    public function storePendaftaran(Request $request)
    {
        $request->validate([
            'id_jadwal' => 'required|exists:jadwal_dokters,id_jadwal',
            'tanggal_daftar' => 'required|date',
            'keluhan' => 'required|string',
        ]);

        // 1. Generate id_pendaftaran sekuensial (format: Pxxx)
        $latestP = Pendaftaran::orderBy('id_pendaftaran', 'desc')->first();
        $numP = 1;
        if ($latestP) {
            // id_pendaftaran format P001
            $numP = ((int) substr($latestP->id_pendaftaran, 1)) + 1;
        }
        $newIdP = 'P' . str_pad($numP, 3, '0', STR_PAD_LEFT);

        // 2. Generate id_antrean sekuensial (format: ANTxxx)
        $latestA = Antrean::orderBy('id_antrean', 'desc')->first();
        $numA = 1;
        if ($latestA) {
            // id_antrean format ANT001
            $numA = ((int) substr($latestA->id_antrean, 3)) + 1;
        }
        $newIdA = 'ANT' . str_pad($numA, 3, '0', STR_PAD_LEFT);

        // 3. Generate nomor_antrean (max nomor_antrean di jadwal ini + 1, default 101)
        $id_jadwal = $request->id_jadwal;
        $maxInJadwal = Antrean::whereHas('pendaftaran', function($q) use ($id_jadwal) {
            $q->where('id_jadwal', $id_jadwal);
        })->max('nomor_antrean');
        $nomorAntrean = $maxInJadwal ? $maxInJadwal + 1 : 101;

        // 4. Ambil info jadwal untuk jam_mulai dan simpan sebagai waktu_antrean
        $jadwal = JadwalDokter::findOrFail($id_jadwal);
        $waktuAntrean = $jadwal->jam_mulai;

        // 5. Simpan Pendaftaran
        $pendaftaran = Pendaftaran::create([
            'id_pendaftaran' => $newIdP,
            'id_user' => Auth::guard('pasien')->id(),
            'id_jadwal' => $id_jadwal,
            'tanggal_daftar' => $request->tanggal_daftar . ' ' . date('H:i:s'),
            'keluhan' => $request->keluhan,
            'status' => 'Menunggu',
        ]);

        // 6. Simpan Antrean
        $antrean = Antrean::create([
            'id_antrean' => $newIdA,
            'id_pendaftaran' => $newIdP,
            'nomor_antrean' => $nomorAntrean,
            'status_antrean' => 'Menunggu',
            'waktu_antrean' => $waktuAntrean,
        ]);

        // Format tanggal Indonesia
        $months = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        $day = $pendaftaran->tanggal_daftar->format('d');
        $monthNum = (int)$pendaftaran->tanggal_daftar->format('m');
        $year = $pendaftaran->tanggal_daftar->format('Y');
        $tanggalIndo = $day . ' ' . ($months[$monthNum] ?? 'Januari') . ' ' . $year;

        return response()->json([
            'success' => true,
            'nomor_antrean' => $nomorAntrean,
            'poli' => $pendaftaran->poli,
            'dokter' => $pendaftaran->dokter,
            'tanggal' => $tanggalIndo,
            'jam' => $pendaftaran->jam,
            'id_pendaftaran' => $newIdP,
        ]);
    }

    // Ambil status antrean terbaru via AJAX (GET /pasien/get-queues)
    public function getQueueStatus()
    {
        $pasien = Auth::guard('pasien')->user();
        if (!$pasien) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        // Fetch called queues ('Dipanggil')
        $calledAntreans = Antrean::where('status_antrean', 'Dipanggil')
            ->with('pendaftaran.pasien', 'pendaftaran.jadwalDokter.dokter.poliklinik')
            ->orderBy('waktu_antrean', 'asc')
            ->get()
            ->map(function ($item) {
                return [
                    'poli' => $item->poli,
                    'nomor_antrean' => $item->nomor_antrean,
                    'nomor_antrean_formatted' => sprintf("%03d", $item->nomor_antrean)
                ];
            });

        // Fetch all queues in the database sequentially
        $allAntreans = Antrean::with('pendaftaran.pasien', 'pendaftaran.jadwalDokter.dokter.poliklinik')
            ->orderBy('id_antrean', 'asc')
            ->get()
            ->map(function ($item) {
                return [
                    'nomor_antrean' => $item->nomor_antrean,
                    'nomor_antrean_formatted' => sprintf("%03d", $item->nomor_antrean),
                    'status_antrean' => $item->status_antrean
                ];
            });

        // Fetch current patient's latest queue registration
        $myLatestAntrean = Antrean::whereHas('pendaftaran', function($q) use ($pasien) {
                $q->where('id_user', $pasien->id_pasien);
            })
            ->with('pendaftaran.jadwalDokter.dokter.poliklinik')
            ->orderBy('created_at', 'desc')
            ->orderBy('id_antrean', 'desc')
            ->first();

        $myStatus = null;
        $estimatedWaitTime = '';
        if ($myLatestAntrean) {
            $myStatus = $myLatestAntrean->status_antrean;
            if ($myStatus === 'Selesai') {
                $estimatedWaitTime = 'Selesai diperiksa';
            } elseif ($myStatus === 'Dipanggil') {
                $estimatedWaitTime = 'Sedang dipanggil / diperiksa';
            } else {
                // Menunggu
                $dokter = $myLatestAntrean->pendaftaran->jadwalDokter->dokter()->first();
                $poliId = $dokter ? $dokter->id_poli : null;
                $myId = $myLatestAntrean->id_antrean;
                $aheadCount = Antrean::where('status_antrean', '!=', 'Selesai')
                    ->where('id_antrean', '<', $myId)
                    ->whereHas('pendaftaran.jadwalDokter.dokter', function($q) use ($poliId) {
                        $q->where('id_poli', $poliId);
                    })
                    ->count();

                $minutes = ($aheadCount + 1) * 15;
                $estimatedWaitTime = $minutes . ' menit lagi';
            }
        }

        return response()->json([
            'calledAntreans' => $calledAntreans,
            'allAntreans' => $allAntreans,
            'myLatestAntrean' => $myLatestAntrean ? [
                'status_antrean' => $myLatestAntrean->status_antrean,
                'estimatedWaitTime' => $estimatedWaitTime
            ] : null
        ]);
    }
}

