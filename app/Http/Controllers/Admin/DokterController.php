<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    // Helper untuk mengambil data dokter dari session (atau inisialisasi default)
    private function getDokters()
    {
        if (session()->has('dokter_list')) {
            $list = session()->get('dokter_list');
            // Reset jika format lama berbeda
            if (count($list) > 0 && !array_key_exists('spesialis', $list[0])) {
                session()->forget('dokter_list');
            }
        }

        if (!session()->has('dokter_list')) {
            $defaultDokters = [
                [
                    'id' => 1,
                    'name' => 'dr. Saepul',
                    'spesialis' => 'Poli Umum',
                    'no_hp' => '08123456789'
                ],
                [
                    'id' => 2,
                    'name' => 'dr. Indi',
                    'spesialis' => 'Poli Gigi',
                    'no_hp' => '0812297120'
                ],
                [
                    'id' => 3,
                    'name' => 'dr. Huru Hara',
                    'spesialis' => 'Poli Anak',
                    'no_hp' => '08123456781'
                ]
            ];
            session()->put('dokter_list', $defaultDokters);
        }
        return collect(session()->get('dokter_list'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $doktersRaw = $this->getDokters();

        if ($search) {
            $doktersRaw = $doktersRaw->filter(function($item) use ($search) {
                return stripos($item['name'], $search) !== false ||
                       stripos($item['spesialis'], $search) !== false ||
                       stripos($item['no_hp'], $search) !== false;
            });
        }

        $dokters = $doktersRaw;

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

        $list = session()->get('dokter_list', []);
        
        $newId = 1;
        if (count($list) > 0) {
            $newId = max(array_column($list, 'id')) + 1;
        }

        $newDokter = [
            'id' => $newId,
            'name' => $request->name,
            'spesialis' => $request->spesialis,
            'no_hp' => $request->no_hp
        ];

        $list[] = $newDokter;
        session()->put('dokter_list', $list);

        return redirect()->route('admin.dokter.index')
            ->with('success', 'Dokter berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dokters = $this->getDokters();
        $dokter = $dokters->firstWhere('id', (int)$id);

        if (!$dokter) {
            abort(404, 'Data dokter tidak ditemukan.');
        }

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

        $list = session()->get('dokter_list', []);
        $found = false;

        foreach ($list as &$item) {
            if ($item['id'] == (int)$id) {
                $item['name'] = $request->name;
                $item['spesialis'] = $request->spesialis;
                $item['no_hp'] = $request->no_hp;
                $found = true;
                break;
            }
        }

        if (!$found) {
            abort(404, 'Data dokter tidak ditemukan.');
        }

        session()->put('dokter_list', $list);

        return redirect()->route('admin.dokter.index')
            ->with('success', 'Data dokter berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $list = session()->get('dokter_list', []);
        $newList = array_filter($list, function($item) use ($id) {
            return $item['id'] != (int)$id;
        });

        session()->put('dokter_list', array_values($newList));

        return redirect()->route('admin.dokter.index')
            ->with('success', 'Data dokter berhasil dihapus.');
    }
}
