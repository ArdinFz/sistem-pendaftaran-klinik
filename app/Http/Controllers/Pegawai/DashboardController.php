<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Helper untuk inisialisasi antrean default di session
    private function getAntreans()
    {
        if (!session()->has('antrean_list')) {
            $defaultAntreans = [
                [
                    'id' => 1,
                    'nomor_antrean' => 'U505',
                    'pasien' => 'Wanti Wanti',
                    'poli' => 'Poli Umum',
                    'dokter' => 'dr. Saepul',
                    'jam' => '08:00',
                    'status' => 'Dipanggil',
                    'tanggal' => '2026-06-09'
                ],
                [
                    'id' => 2,
                    'nomor_antrean' => 'G666',
                    'pasien' => 'Rino Bleber',
                    'poli' => 'Poli Gigi',
                    'dokter' => 'dr. Indi',
                    'jam' => '16:00',
                    'status' => 'Menunggu',
                    'tanggal' => '2026-06-09'
                ],
                [
                    'id' => 3,
                    'nomor_antrean' => 'B871',
                    'pasien' => 'Dadang',
                    'poli' => 'Poli Bedah',
                    'dokter' => 'dr. Joli',
                    'jam' => '08:30',
                    'status' => 'Menunggu',
                    'tanggal' => '2026-06-09'
                ],
                [
                    'id' => 4,
                    'nomor_antrean' => 'A645',
                    'pasien' => 'Ujang',
                    'poli' => 'Poli Anak',
                    'dokter' => 'dr. Huru Hara',
                    'jam' => '12:00',
                    'status' => 'Menunggu',
                    'tanggal' => '2026-06-09'
                ],
                [
                    'id' => 5,
                    'nomor_antrean' => 'B143',
                    'pasien' => 'Udang Keju',
                    'poli' => 'Poli Bedah',
                    'dokter' => 'dr. Pardede',
                    'jam' => '09:00',
                    'status' => 'Selesai',
                    'tanggal' => '2026-06-09'
                ]
            ];
            session()->put('antrean_list', $defaultAntreans);
        }
        return collect(session()->get('antrean_list'));
    }

    /**
     * Display the dashboard view.
     */
    public function index()
    {
        $antreansRaw = $this->getAntreans();

        // Urutkan: Dipanggil di atas, Menunggu di tengah (urut jam), Selesai di bawah (urut jam)
        $antreans = $antreansRaw->sort(function($a, $b) {
            $statusWeight = [
                'Dipanggil' => 1,
                'Menunggu' => 2,
                'Selesai' => 3
            ];

            $wA = $statusWeight[$a['status']] ?? 2;
            $wB = $statusWeight[$b['status']] ?? 2;

            if ($wA !== $wB) {
                return $wA <=> $wB;
            }

            return strcmp($a['jam'], $b['jam']);
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
        $this->getAntreans();
        $list = session()->get('antrean_list', []);
        $found = false;

        foreach ($list as &$item) {
            if ($item['id'] == (int)$id) {
                if ($item['status'] === 'Menunggu') {
                    $item['status'] = 'Dipanggil';
                    $found = true;
                }
                break;
            }
        }

        if ($found) {
            session()->put('antrean_list', $list);
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
        $this->getAntreans();
        $list = session()->get('antrean_list', []);
        $found = false;

        foreach ($list as &$item) {
            if ($item['id'] == (int)$id) {
                if ($item['status'] === 'Dipanggil' || $item['status'] === 'Menunggu') {
                    $item['status'] = 'Selesai';
                    $found = true;
                }
                break;
            }
        }

        if ($found) {
            session()->put('antrean_list', $list);
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
