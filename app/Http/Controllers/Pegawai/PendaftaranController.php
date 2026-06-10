<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Poliklinik;
use App\Models\Dokter;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of pendaftaran.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $tanggalAwal = $request->input('tanggal_awal', '2026-05-08');
        $tanggalAkhir = $request->input('tanggal_akhir', '2026-05-09');
        $selectedPoli = $request->input('poli');
        $selectedDokter = $request->input('dokter');

        $pendaftarans = Pendaftaran::query()
            ->when($tanggalAwal, function ($query, $tanggalAwal) {
                $query->whereDate('tanggal', '>=', $tanggalAwal);
            })
            ->when($tanggalAkhir, function ($query, $tanggalAkhir) {
                $query->whereDate('tanggal', '<=', $tanggalAkhir);
            })
            ->when($selectedPoli && $selectedPoli !== 'Semua Poli', function ($query) use ($selectedPoli) {
                $query->where('poli', $selectedPoli);
            })
            ->when($selectedDokter && $selectedDokter !== 'Semua Dokter', function ($query) use ($selectedDokter) {
                $query->where('dokter', $selectedDokter);
            })
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('pasien', 'like', "%{$search}%")
                      ->orWhere('nik', 'like', "%{$search}%");
                });
            })
            ->orderBy('jam', 'asc')
            ->get();

        $polikliniks = Poliklinik::all();
        $dokters = Dokter::all();

        return view('backend.pegawai.pendaftaran.index', compact(
            'pendaftarans', 'search', 'tanggalAwal', 'tanggalAkhir', 'selectedPoli', 'selectedDokter', 'polikliniks', 'dokters'
        ));
    }

    /**
     * Display detail pendaftaran.
     */
    public function show(string $id)
    {
        $pendaftaran = Pendaftaran::where('no', $id)->firstOrFail();

        return view('backend.pegawai.pendaftaran.show', compact('pendaftaran'));
    }
}
