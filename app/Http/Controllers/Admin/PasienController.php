<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    // Helper untuk mengambil data pasien dari session (atau membuat inisialisasi default)
    private function getPasiens()
    {
        if (session()->has('pasien_list')) {
            $pasiens = session()->get('pasien_list');
            if (count($pasiens) > 0 && !array_key_exists('email', $pasiens[0])) {
                session()->forget('pasien_list');
            }
        }

        if (!session()->has('pasien_list')) {
            $defaultPasiens = [
                [
                    'id' => 1,
                    'no' => '001',
                    'name' => 'Wira Sonic',
                    'nik' => '1234567890',
                    'email' => 'wira@gmail.com',
                    'tanggal_lahir' => '2005-05-25',
                    'no_hp' => '0852497264',
                    'alamat' => 'Jalan Asoman',
                    'foto' => null
                ],
                [
                    'id' => 2,
                    'no' => '002',
                    'name' => 'Galang Rading',
                    'nik' => '0987123432',
                    'email' => 'galang@gmail.com',
                    'tanggal_lahir' => '1999-06-21',
                    'no_hp' => '089621327113',
                    'alamat' => 'Gg. Kasih Mandiri',
                    'foto' => null
                ]
            ];
            session()->put('pasien_list', $defaultPasiens);
        }
        return collect(session()->get('pasien_list'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $pasiensRaw = $this->getPasiens();

        if ($search) {
            $pasiensRaw = $pasiensRaw->filter(function($item) use ($search) {
                return stripos($item['name'], $search) !== false ||
                       stripos($item['nik'], $search) !== false ||
                       stripos($item['email'], $search) !== false ||
                       stripos($item['alamat'], $search) !== false ||
                       stripos($item['no_hp'], $search) !== false;
            });
        }

        $pasiens = $pasiensRaw;

        return view('backend.admin.pasien.index', compact('pasiens', 'search'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pasiens = $this->getPasiens();
        $pasien = $pasiens->firstWhere('id', (int)$id);

        if (!$pasien) {
            abort(404, 'Data pasien tidak ditemukan.');
        }

        return view('backend.admin.pasien.show', compact('pasien'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pasiens = $this->getPasiens();
        $pasien = $pasiens->firstWhere('id', (int)$id);

        if (!$pasien) {
            abort(404, 'Data pasien tidak ditemukan.');
        }

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

        $pasiens = session()->get('pasien_list', []);
        $found = false;

        foreach ($pasiens as &$item) {
            if ($item['id'] == (int)$id) {
                $item['name'] = $request->name;
                $item['nik'] = $request->nik;
                $item['email'] = $request->email;
                $item['tanggal_lahir'] = $request->tanggal_lahir;
                $item['no_hp'] = $request->no_hp;
                $item['alamat'] = $request->alamat;

                if ($request->hasFile('foto')) {
                    $file = $request->file('foto');
                    $filename = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/pasien'), $filename);
                    $item['foto'] = 'uploads/pasien/' . $filename;
                }

                $found = true;
                break;
            }
        }

        if (!$found) {
            abort(404, 'Data pasien tidak ditemukan.');
        }

        session()->put('pasien_list', $pasiens);

        return redirect()->route('admin.pasien.index')
            ->with('success', 'Data pasien berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pasiens = session()->get('pasien_list', []);
        $newPasiens = array_filter($pasiens, function($item) use ($id) {
            return $item['id'] != (int)$id;
        });

        // Reset index array
        session()->put('pasien_list', array_values($newPasiens));

        return redirect()->route('admin.pasien.index')
            ->with('success', 'Data pasien berhasil dihapus.');
    }
}
