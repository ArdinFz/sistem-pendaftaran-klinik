<?php

namespace App\Http\Controllers\Pegawai;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    // Helper untuk inisialisasi antrean default di session jika belum ada
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
     * Display a listing of pendaftaran.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $antreansRaw = $this->getAntreans();

        if ($search) {
            $antreansRaw = $antreansRaw->filter(function ($item) use ($search) {
                return stripos($item['pasien'], $search) !== false ||
                       stripos($item['nomor_antrean'], $search) !== false ||
                       stripos($item['poli'], $search) !== false ||
                       stripos($item['dokter'], $search) !== false ||
                       stripos($item['status'], $search) !== false;
            });
        }

        // Urutkan data pasien sesuai jamnya secara menaik (jam periksa)
        $pendaftarans = $antreansRaw->sortBy('jam');

        return view('backend.pegawai.pendaftaran.index', compact('pendaftarans', 'search'));
    }
}
