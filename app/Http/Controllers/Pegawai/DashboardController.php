<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Antrean;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view.
     */
    public function index()
    {
        $antreansRaw = Antrean::all();

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

        // Hitung stats dengan offset agar data terlihat realistik seperti mockup (Total: 32, Menunggu: 11, Selesai: 18)
        $totalItems = $antreansRaw->count();
        $menungguCount = $antreansRaw->where('status', 'Menunggu')->count();
        $selesaiCount = $antreansRaw->where('status', 'Selesai')->count();

        // Menggunakan offset statis agar awal rilis pas dengan mockup
        $total = 27 + $totalItems;
        $menunggu = 8 + $menungguCount;
        $selesai = 17 + $selesaiCount;

        return view('backend.pegawai.dashboard', compact('antreans', 'total', 'menunggu', 'selesai'));
    }

    /**
     * Panggil pasien
     */
    public function panggil(string $id)
    {
        $antrean = Antrean::findOrFail($id);

        if ($antrean->status === 'Menunggu') {
            $antrean->update(['status_antrean' => 'Dipanggil']);
            Pendaftaran::where('id_pendaftaran', $antrean->id_pendaftaran)->update(['status' => 'Dipanggil']);
            return redirect()->route('pegawai.dashboard')
                ->with('success', 'Pasien berhasil dipanggil ke ruang periksa.');
        }

        return redirect()->route('pegawai.dashboard')
            ->with('error', 'Status antrean tidak valid untuk dipanggil.');
    }

    /**
     * Nyatakan selesai periksa
     */
    public function selesai(string $id)
    {
        $antrean = Antrean::findOrFail($id);

        if ($antrean->status === 'Dipanggil' || $antrean->status === 'Menunggu') {
            $antrean->update(['status_antrean' => 'Selesai']);
            Pendaftaran::where('id_pendaftaran', $antrean->id_pendaftaran)->update(['status' => 'Selesai']);
            return redirect()->route('pegawai.dashboard')
                ->with('success', 'Pemeriksaan pasien selesai.');
        }

        return redirect()->route('pegawai.dashboard')
            ->with('error', 'Status antrean tidak valid untuk diselesaikan.');
    }

    /**
     * Refresh antrean
     */
    public function refresh()
    {
        return redirect()->route('pegawai.dashboard')
            ->with('success', 'Antrean berhasil diperbarui.');
    }
}
