<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Poliklinik;
use Illuminate\Http\Request;

class PoliklinikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $polikliniks = Poliklinik::query()
            ->when($search, function ($query, $search) {
                $query->where('nama_poli', 'like', "%{$search}%")
                      ->orWhere('deskripsi_poli', 'like', "%{$search}%");
            })
            ->get();

        return view('backend.admin.poliklinik.index', compact('polikliniks', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.poliklinik.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);

        // Generate ID: format PL01
        $latest = Poliklinik::orderBy('id_poli', 'desc')->first();
        $num = $latest ? ((int) substr($latest->id_poli, 2) + 1) : 1;
        $newId = 'PL' . str_pad($num, 2, '0', STR_PAD_LEFT);

        Poliklinik::create([
            'id_poli' => $newId,
            'nama_poli' => $request->nama_poli,
            'deskripsi_poli' => $request->deskripsi
        ]);

        return redirect()->route('admin.poliklinik.index')
            ->with('success', 'Poliklinik berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $poliklinik = Poliklinik::findOrFail($id);
        return view('backend.admin.poliklinik.edit', compact('poliklinik'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_poli' => 'required|string|max:255',
            'deskripsi' => 'required|string'
        ]);

        $poliklinik = Poliklinik::findOrFail($id);
        $poliklinik->update([
            'nama_poli' => $request->nama_poli,
            'deskripsi_poli' => $request->deskripsi
        ]);

        return redirect()->route('admin.poliklinik.index')
            ->with('success', 'Poliklinik berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $poliklinik = Poliklinik::findOrFail($id);
        $poliklinik->delete();

        return redirect()->route('admin.poliklinik.index')
            ->with('success', 'Poliklinik berhasil dihapus.');
    }
}
