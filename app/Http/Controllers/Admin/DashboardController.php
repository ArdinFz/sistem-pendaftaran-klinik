<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil nama admin yang sedang login
        $adminName = Auth::user() ? Auth::user()->name : 'Ketoprak';

        // Menggunakan try-catch agar jika Anda belum migrate DB, dashboard tetap tampil menggunakan data dummy
        try {
            // Uncomment bagian ini jika database Anda sudah siap:
            // $totalPasien = \App\Models\Pasien::count();
            // $totalDokter = \App\Models\Dokter::count();
            // $totalPendaftaranHariIni = \App\Models\Pendaftaran::whereDate('created_at', today())->count();
            // $antreans = \App\Models\Antrean::whereDate('created_at', today())->get();
            
            throw new \Exception("Gunakan data dummy");
        } catch (\Exception $e) {
            // Data Dummy Fallback sesuai gambar mockup
            $totalPasien = 67;
            $totalDokter = 12;
            $totalPendaftaranHariIni = 10;

            $antreans = collect([
                (object)[
                    'nomor_antrean' => '505',
                    'nama_pasien' => 'Abdul Kodir',
                    'poli' => 'Poli Umum',
                    'dokter' => 'dr. Saepul',
                    'jam' => '08:00',
                    'status' => 'Dipanggil'
                ],
                (object)[
                    'nomor_antrean' => '677',
                    'nama_pasien' => 'Wisnu Bolak Balek',
                    'poli' => 'Poli Gigi',
                    'dokter' => 'dr. Sapidol',
                    'jam' => '16:00',
                    'status' => 'Menunggu'
                ],
                (object)[
                    'nomor_antrean' => '003',
                    'nama_pasien' => 'Dadang',
                    'poli' => 'Poli Gigi',
                    'dokter' => 'dr. Joli',
                    'jam' => '08.30',
                    'status' => 'Selesai'
                ]
            ]);
        }

        // Tambahkan "backend." di bagian paling depan
        return view('backend.admin.dashboard.index', compact('totalPasien', 'totalDokter', 'totalPendaftaranHariIni', 'antreans', 'adminName'));
    }
}