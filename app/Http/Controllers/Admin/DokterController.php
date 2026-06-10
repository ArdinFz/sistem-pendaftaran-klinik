<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Poliklinik;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $dokters = Dokter::query()
            ->when($search, function ($query, $search) {
                $query->where('nama_dokter', 'like', "%{$search}%")
                      ->orWhereHas('poliklinik', function ($q) use ($search) {
                          $q->where('nama_poli', 'like', "%{$search}%");
                      })
                      ->orWhere('no_hp', 'like', "%{$search}%");
            })
            ->get();

        return view('backend.admin.dokter.index', compact('dokters', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.dokter.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'spesialis' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20'
        ]);

        // Look up poliklinik or create it
        $poli = Poliklinik::where('nama_poli', 'like', "%{$request->spesialis}%")->first();
        if (!$poli) {
            $latest = Poliklinik::orderBy('id_poli', 'desc')->first();
            $num = $latest ? ((int) substr($latest->id_poli, 2) + 1) : 1;
            $newId = 'PL' . str_pad($num, 2, '0', STR_PAD_LEFT);
            $poli = Poliklinik::create([
                'id_poli' => $newId,
                'nama_poli' => $request->spesialis,
                'deskripsi_poli' => 'Deskripsi untuk poliklinik ' . $request->spesialis,
            ]);
        }

        // Generate Dokter ID: format DK001
        $latestDoc = Dokter::orderBy('id_dokter', 'desc')->first();
        $numDoc = $latestDoc ? ((int) substr($latestDoc->id_dokter, 2) + 1) : 1;
        $newDocId = 'DK' . str_pad($numDoc, 3, '0', STR_PAD_LEFT);

        Dokter::create([
            'id_dokter' => $newDocId,
            'id_poli' => $poli->id_poli,
            'nama_dokter' => $request->name,
            'no_hp' => $request->no_hp
        ]);

        return redirect()->route('admin.dokter.index')
            ->with('success', 'Dokter berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dokter = Dokter::findOrFail($id);
        return view('backend.admin.dokter.edit', compact('dokter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'spesialis' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20'
        ]);

        // Look up poliklinik or create it
        $poli = Poliklinik::where('nama_poli', 'like', "%{$request->spesialis}%")->first();
        if (!$poli) {
            $latest = Poliklinik::orderBy('id_poli', 'desc')->first();
            $num = $latest ? ((int) substr($latest->id_poli, 2) + 1) : 1;
            $newId = 'PL' . str_pad($num, 2, '0', STR_PAD_LEFT);
            $poli = Poliklinik::create([
                'id_poli' => $newId,
                'nama_poli' => $request->spesialis,
                'deskripsi_poli' => 'Deskripsi untuk poliklinik ' . $request->spesialis,
            ]);
        }

        $dokter = Dokter::findOrFail($id);
        $dokter->update([
            'id_poli' => $poli->id_poli,
            'nama_dokter' => $request->name,
            'no_hp' => $request->no_hp
        ]);

        return redirect()->route('admin.dokter.index')
            ->with('success', 'Data dokter berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dokter = Dokter::findOrFail($id);
        $dokter->delete();

        return redirect()->route('admin.dokter.index')
            ->with('success', 'Data dokter berhasil dihapus.');
    }
}
