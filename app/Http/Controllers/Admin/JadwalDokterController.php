<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JadwalDokterController extends Controller
{
    // Helper untuk mengambil data jadwal dari session (atau membuat inisialisasi default)
    private function getJadwals()
    {
        if (!session()->has('jadwal_dokter_list')) {
            $defaultJadwals = [
                [
                    'id' => 1,
                    'dokter' => 'dr. Saepul',
                    'poliklinik' => 'Poli Umum',
                    'hari' => 'Senin',
                    'jam_mulai' => '08:00',
                    'jam_selesai' => '10:00',
                    'kuota' => 20
                ],
                [
                    'id' => 2,
                    'dokter' => 'dr. Indi',
                    'poliklinik' => 'Poli Gigi',
                    'hari' => 'Rabu',
                    'jam_mulai' => '08:30',
                    'jam_selesai' => '12:00',
                    'kuota' => 10
                ],
                [
                    'id' => 3,
                    'dokter' => 'dr. Huru Hara',
                    'poliklinik' => 'Poli Anak',
                    'hari' => 'Rabu',
                    'jam_mulai' => '08:00',
                    'jam_selesai' => '11:00',
                    'kuota' => 5
                ]
            ];
            session()->put('jadwal_dokter_list', $defaultJadwals);
        }
        return collect(session()->get('jadwal_dokter_list'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $jadwalsRaw = $this->getJadwals();

        if ($search) {
            $jadwalsRaw = $jadwalsRaw->filter(function($item) use ($search) {
                return stripos($item['dokter'], $search) !== false ||
                       stripos($item['poliklinik'], $search) !== false ||
                       stripos($item['hari'], $search) !== false;
            });
        }

        $jadwals = $jadwalsRaw;

        return view('backend.admin.jadwal_dokter.index', compact('jadwals', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dokters = collect(session()->get('dokter_list', [
            ['id' => 1, 'name' => 'dr. Saepul'],
            ['id' => 2, 'name' => 'dr. Indi'],
            ['id' => 3, 'name' => 'dr. Huru Hara']
        ]))->pluck('name')->toArray();

        $polikliniks = collect(session()->get('poliklinik_list', [
            ['id' => 1, 'nama_poli' => 'Poli Umum'],
            ['id' => 2, 'nama_poli' => 'Poli Gigi'],
            ['id' => 3, 'nama_poli' => 'Poli Anak']
        ]))->pluck('nama_poli')->toArray();

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

        $jadwals = session()->get('jadwal_dokter_list', []);
        
        $newId = 1;
        if (count($jadwals) > 0) {
            $newId = max(array_column($jadwals, 'id')) + 1;
        }

        $newJadwal = [
            'id' => $newId,
            'dokter' => $request->dokter,
            'poliklinik' => $request->poliklinik,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'kuota' => (int)$request->kuota
        ];

        $jadwals[] = $newJadwal;
        session()->put('jadwal_dokter_list', $jadwals);

        return redirect()->route('admin.jadwal-dokter.index')
            ->with('success', 'Jadwal dokter berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jadwals = $this->getJadwals();
        $jadwal = $jadwals->firstWhere('id', (int)$id);

        if (!$jadwal) {
            abort(404, 'Jadwal dokter tidak ditemukan.');
        }

        $dokters = collect(session()->get('dokter_list', [
            ['id' => 1, 'name' => 'dr. Saepul'],
            ['id' => 2, 'name' => 'dr. Indi'],
            ['id' => 3, 'name' => 'dr. Huru Hara']
        ]))->pluck('name')->toArray();

        $polikliniks = collect(session()->get('poliklinik_list', [
            ['id' => 1, 'nama_poli' => 'Poli Umum'],
            ['id' => 2, 'nama_poli' => 'Poli Gigi'],
            ['id' => 3, 'nama_poli' => 'Poli Anak']
        ]))->pluck('nama_poli')->toArray();

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

        $jadwals = session()->get('jadwal_dokter_list', []);
        $found = false;

        foreach ($jadwals as &$item) {
            if ($item['id'] == (int)$id) {
                $item['dokter'] = $request->dokter;
                $item['poliklinik'] = $request->poliklinik;
                $item['hari'] = $request->hari;
                $item['jam_mulai'] = $request->jam_mulai;
                $item['jam_selesai'] = $request->jam_selesai;
                $item['kuota'] = (int)$request->kuota;
                $found = true;
                break;
            }
        }

        if (!$found) {
            abort(404, 'Jadwal dokter tidak ditemukan.');
        }

        session()->put('jadwal_dokter_list', $jadwals);

        return redirect()->route('admin.jadwal-dokter.index')
            ->with('success', 'Jadwal dokter berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jadwals = session()->get('jadwal_dokter_list', []);
        $newJadwals = array_filter($jadwals, function($item) use ($id) {
            return $item['id'] != (int)$id;
        });

        // Reset index array
        session()->put('jadwal_dokter_list', array_values($newJadwals));

        return redirect()->route('admin.jadwal-dokter.index')
            ->with('success', 'Jadwal dokter berhasil dihapus.');
    }
}
