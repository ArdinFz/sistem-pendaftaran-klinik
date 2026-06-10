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
        $adminName = Auth::user() ? Auth::user()->Nama : 'Ketoprak';

        $totalPasien = \App\Models\Pasien::count();
        $totalDokter = \App\Models\Dokter::count();
        $totalPendaftaranHariIni = \App\Models\Pendaftaran::count();

        $antreansRaw = \App\Models\Antrean::all();

        // Urutkan: Dipanggil di atas, Menunggu di tengah (urut jam), Selesai di bawah (urut jam)
        $antreans = $antreansRaw->sort(function($a, $b) {
            $statusWeight = [
                'Dipanggil' => 1,
                'Menunggu' => 2,
                'Selesai' => 3
            ];

            $wA = $statusWeight[$a->status] ?? 2;
            $wB = $statusWeight[$b->status] ?? 2;

            if ($wA !== $wB) {
                return $wA <=> $wB;
            }

            return strcmp($a->jam, $b->jam);
        });

        // Tambahkan "backend." di bagian paling depan
        return view('backend.admin.dashboard.index', compact('totalPasien', 'totalDokter', 'totalPendaftaranHariIni', 'antreans', 'adminName'));
    }
}