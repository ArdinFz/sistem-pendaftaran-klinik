<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalDokter;
use App\Models\Dokter;
use App\Models\Poliklinik;
use Illuminate\Http\Request;

class JadwalDokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $jadwals = JadwalDokter::query()
            ->when($search, function ($query, $search) {
                $query->where('dokter', 'like', "%{$search}%")
                      ->orWhere('poliklinik', 'like', "%{$search}%")
                      ->orWhere('hari', 'like', "%{$search}%");
            })
            ->get();

        return view('backend.admin.jadwal_dokter.index', compact('jadwals', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dokters = Dokter::all()->pluck('name')->toArray();
        $polikliniks = Poliklinik::all()->pluck('nama_poli')->toArray();
        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        return view('backend.admin.jadwal_dokter.create', compact('dokters', 'polikliniks', 'hariList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'dokter' => 'required|string',
            'poliklinik' => 'required|string',
            'hari' => 'required|string',
            'jam_mulai' => 'required|string',
            'jam_selesai' => 'required|string',
            'kuota' => 'required|integer|min:1'
        ]);

        JadwalDokter::create([
            'dokter' => $request->dokter,
            'poliklinik' => $request->poliklinik,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'kuota' => (int)$request->kuota
        ]);

        return redirect()->route('admin.jadwal-dokter.index')
            ->with('success', 'Jadwal dokter berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jadwal = JadwalDokter::findOrFail($id);
        $dokters = Dokter::all()->pluck('name')->toArray();
        $polikliniks = Poliklinik::all()->pluck('nama_poli')->toArray();
        $hariList = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        return view('backend.admin.jadwal_dokter.edit', compact('jadwal', 'dokters', 'polikliniks', 'hariList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'dokter' => 'required|string',
            'poliklinik' => 'required|string',
            'hari' => 'required|string',
            'jam_mulai' => 'required|string',
            'jam_selesai' => 'required|string',
            'kuota' => 'required|integer|min:1'
        ]);

        $jadwal = JadwalDokter::findOrFail($id);
        $jadwal->update([
            'dokter' => $request->dokter,
            'poliklinik' => $request->poliklinik,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'kuota' => (int)$request->kuota
        ]);

        return redirect()->route('admin.jadwal-dokter.index')
            ->with('success', 'Jadwal dokter berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwal = JadwalDokter::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal-dokter.index')
            ->with('success', 'Jadwal dokter berhasil dihapus.');
    }
}
