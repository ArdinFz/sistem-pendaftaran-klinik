<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PoliklinikController extends Controller
{
    // Helper untuk mengambil data poliklinik dari session (atau inisialisasi default)
    private function getPolikliniks()
    {
        if (session()->has('poliklinik_list')) {
            $list = session()->get('poliklinik_list');
            // Reset jika format lama berbeda
            if (count($list) > 0 && !array_key_exists('nama_poli', $list[0])) {
                session()->forget('poliklinik_list');
            }
        }

        if (!session()->has('poliklinik_list')) {
            $defaultPolikliniks = [
                [
                    'id' => 1,
                    'nama_poli' => 'Poli Umum',
                    'deskripsi' => 'Pelayanan Kesehatan Umum'
                ],
                [
                    'id' => 2,
                    'nama_poli' => 'Poli Gigi',
                    'deskripsi' => 'Pemeriksaan dan Perawatan Gigi'
                ],
                [
                    'id' => 3,
                    'nama_poli' => 'Poli Anak',
                    'deskripsi' => 'Layanan Kesehatan Anak'
                ]
            ];
            session()->put('poliklinik_list', $defaultPolikliniks);
        }
        return collect(session()->get('poliklinik_list'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $polikliniksRaw = $this->getPolikliniks();

        if ($search) {
            $polikliniksRaw = $polikliniksRaw->filter(function($item) use ($search) {
                return stripos($item['nama_poli'], $search) !== false ||
                       stripos($item['deskripsi'], $search) !== false;
            });
        }

        $polikliniks = $polikliniksRaw;

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

        $list = session()->get('poliklinik_list', []);
        
        $newId = 1;
        if (count($list) > 0) {
            $newId = max(array_column($list, 'id')) + 1;
        }

        $newPoliklinik = [
            'id' => $newId,
            'nama_poli' => $request->nama_poli,
            'deskripsi' => $request->deskripsi
        ];

        $list[] = $newPoliklinik;
        session()->put('poliklinik_list', $list);

        return redirect()->route('admin.poliklinik.index')
            ->with('success', 'Poliklinik berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $polikliniks = $this->getPolikliniks();
        $poliklinik = $polikliniks->firstWhere('id', (int)$id);

        if (!$poliklinik) {
            abort(404, 'Data poliklinik tidak ditemukan.');
        }

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

        $list = session()->get('poliklinik_list', []);
        $found = false;

        foreach ($list as &$item) {
            if ($item['id'] == (int)$id) {
                $item['nama_poli'] = $request->nama_poli;
                $item['deskripsi'] = $request->deskripsi;
                $found = true;
                break;
            }
        }

        if (!$found) {
            abort(404, 'Data poliklinik tidak ditemukan.');
        }

        session()->put('poliklinik_list', $list);

        return redirect()->route('admin.poliklinik.index')
            ->with('success', 'Poliklinik berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $list = session()->get('poliklinik_list', []);
        $newList = array_filter($list, function($item) use ($id) {
            return $item['id'] != (int)$id;
        });

        session()->put('poliklinik_list', array_values($newList));

        return redirect()->route('admin.poliklinik.index')
            ->with('success', 'Poliklinik berhasil dihapus.');
    }
}
