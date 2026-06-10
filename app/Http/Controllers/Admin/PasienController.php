<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pasiens = Pasien::query()
            ->when($search, function ($query, $search) {
                $query->where('nama', 'like', "%{$search}%")
                      ->orWhere('nik', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('alamat', 'like', "%{$search}%")
                      ->orWhere('no_hp', 'like', "%{$search}%");
            })
            ->get();

        return view('backend.admin.pasien.index', compact('pasiens', 'search'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('backend.admin.pasien.show', compact('pasien'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pasien = Pasien::findOrFail($id);
        return view('backend.admin.pasien.edit', compact('pasien'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:50',
            'email' => 'required|email|max:255',
            'tanggal_lahir' => 'required|date',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'foto' => 'nullable|image|max:2048'
        ]);

        $pasien = Pasien::findOrFail($id);

        $pasienData = [
            'nama' => $request->name,
            'nik' => $request->nik,
            'email' => $request->email,
            'tanggal_lahir' => $request->tanggal_lahir,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
        ];

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($pasien->foto && file_exists(public_path($pasien->foto))) {
                @unlink(public_path($pasien->foto));
            }
            $file = $request->file('foto');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/pasien'), $filename);
            $pasienData['foto'] = 'uploads/pasien/' . $filename;
        }

        $pasien->update($pasienData);

        return redirect()->route('admin.pasien.index')
            ->with('success', 'Data pasien berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pasien = Pasien::findOrFail($id);

        // Hapus foto jika ada
        if ($pasien->foto && file_exists(public_path($pasien->foto))) {
            @unlink(public_path($pasien->foto));
        }

        $pasien->delete();

        return redirect()->route('admin.pasien.index')
            ->with('success', 'Data pasien berhasil dihapus.');
    }
}
