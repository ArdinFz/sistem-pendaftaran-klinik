<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    // Helper untuk mengambil koleksi data detail pendaftaran (dummy) lengkap dengan rekam medis kustom
    private function getDetailPendaftarans()
    {
        return collect([
            (object)[
                'no' => '001',
                'id_pendaftaran' => 'P001',
                'tanggal' => '2026-05-08',
                'nomor_antrean' => '505',
                // Data Pasien
                'pasien' => 'Wanti Wanti',
                'nik' => '108230198230182390',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '13-05-1990',
                'email' => 'wanti@gmail.com',
                'no_hp' => '08192912093029',
                'alamat' => 'Sleman',
                // Data Pemeriksaan
                'poli' => 'Poli Umum',
                'dokter' => 'dr. Saepul',
                'hari_periksa' => 'Senin',
                'jam' => '08.00 - 08.30',
                // Keluhan
                'keluhan' => 'Gak tau dog, kayaknya flu deh ini dog, kemarin demam gitu dog, cuma sekarang sembuh dog, cuma kadang kejang-kejang juga dog, gimana ya dog? sembuhin atuh dog, dog kan dogter!'
            ],
            (object)[
                'no' => '002',
                'id_pendaftaran' => 'P002',
                'tanggal' => '2026-05-08',
                'nomor_antrean' => '506',
                // Data Pasien
                'pasien' => 'Rino Bleber',
                'nik' => '3273010202020002',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '14-06-1992',
                'email' => 'rino@gmail.com',
                'no_hp' => '08123456780',
                'alamat' => 'Yogyakarta',
                // Data Pemeriksaan
                'poli' => 'Poli Umum',
                'dokter' => 'dr. Indi',
                'hari_periksa' => 'Selasa',
                'jam' => '09.00 - 10.00',
                // Keluhan
                'keluhan' => 'Sakit kepala sebelah kanan saja sejak kemarin pagi, kepala terasa seperti berdenyut-denyut kencang saat beraktivitas berat.'
            ],
            (object)[
                'no' => '003',
                'id_pendaftaran' => 'P003',
                'tanggal' => '2026-05-08',
                'nomor_antrean' => '003',
                // Data Pasien
                'pasien' => 'Dadang',
                'nik' => '3273010303030003',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '25-09-1985',
                'email' => 'dadang@gmail.com',
                'no_hp' => '08123456781',
                'alamat' => 'Bantul',
                // Data Pemeriksaan
                'poli' => 'Poli Gigi',
                'dokter' => 'dr. Joli',
                'hari_periksa' => 'Rabu',
                'jam' => '10.00 - 11.00',
                // Keluhan
                'keluhan' => 'Gigi geraham belakang kanan bawah berlubang besar dan terasa sangat linu ketika dipakai makan manis atau minum air dingin.'
            ],
            (object)[
                'no' => '004',
                'id_pendaftaran' => 'P004',
                'tanggal' => '2026-05-09',
                'nomor_antrean' => '004',
                // Data Pasien
                'pasien' => 'Ujang',
                'nik' => '3273010404040004',
                'jenis_kelamin' => 'Laki-laki',
                'tanggal_lahir' => '30-11-2015',
                'email' => 'ujang@gmail.com',
                'no_hp' => '08123456782',
                'alamat' => 'Kulon Progo',
                // Data Pemeriksaan
                'poli' => 'Poli Anak',
                'dokter' => 'dr. Huru Hara',
                'hari_periksa' => 'Kamis',
                'jam' => '11.00 - 12.00',
                // Keluhan
                'keluhan' => 'Badan anak demam naik turun sejak 3 hari lalu, pilek mampet, batuk berdahak, serta tidak mau makan sama sekali.'
            ],
            (object)[
                'no' => '005',
                'id_pendaftaran' => 'P005',
                'tanggal' => '2026-05-09',
                'nomor_antrean' => '005',
                // Data Pasien
                'pasien' => 'Udang Keju',
                'nik' => '3273010505050005',
                'jenis_kelamin' => 'Perempuan',
                'tanggal_lahir' => '18-02-1999',
                'email' => 'udangkeju@gmail.com',
                'no_hp' => '08123456783',
                'alamat' => 'Gunungkidul',
                // Data Pemeriksaan
                'poli' => 'Poli Bedah',
                'dokter' => 'dr. Pardede',
                'hari_periksa' => 'Jumat',
                'jam' => '13.00 - 14.00',
                // Keluhan
                'keluhan' => 'Luka robek berdarah pada telapak kaki kiri akibat tidak sengaja menginjak pecahan botol kaca kemarin sore.'
            ],
        ]);
    }

    // Mengambil data pendaftaran (dengan filter) untuk halaman laporan utama
    public function index(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $search = $request->input('search');

        if (!$tanggalAwal && !$tanggalAkhir && !$search) {
            $tanggalAwal = '2026-05-08';
            $tanggalAkhir = '2026-05-09';
        }

        try {
            // Code database riil...
            throw new \Exception("Gunakan data dummy");
        } catch (\Exception $e) {
            $pendaftaransRaw = $this->getDetailPendaftarans();

            if ($tanggalAwal) {
                $pendaftaransRaw = $pendaftaransRaw->filter(fn($item) => $item->tanggal >= $tanggalAwal);
            }
            if ($tanggalAkhir) {
                $pendaftaransRaw = $pendaftaransRaw->filter(fn($item) => $item->tanggal <= $tanggalAkhir);
            }
            if ($search) {
                $pendaftaransRaw = $pendaftaransRaw->filter(fn($item) => 
                    stripos($item->pasien, $search) !== false || 
                    stripos($item->dokter, $search) !== false ||
                    stripos($item->poli, $search) !== false
                );
            }

            $totalPendaftaran = $pendaftaransRaw->count();
            $pendaftarans = $pendaftaransRaw;
        }

        return view('backend.admin.laporan.index', compact('pendaftarans', 'tanggalAwal', 'tanggalAkhir', 'search', 'totalPendaftaran'));
    }

    // Menerima input filter POST dan me-redirect ke GET index dengan parameter query
    public function filter(Request $request)
    {
        return redirect()->route('admin.laporan.index', [
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'search' => $request->search,
        ]);
    }

    // Menampilkan halaman cetak khusus untuk menu print browser
    public function cetakPdf(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');
        $search = $request->input('search');

        try {
            // Code database riil...
            throw new \Exception("Data dummy");
        } catch (\Exception $e) {
            $pendaftaransRaw = $this->getDetailPendaftarans();

            if ($tanggalAwal) {
                $pendaftaransRaw = $pendaftaransRaw->filter(fn($item) => $item->tanggal >= $tanggalAwal);
            }
            if ($tanggalAkhir) {
                $pendaftaransRaw = $pendaftaransRaw->filter(fn($item) => $item->tanggal <= $tanggalAkhir);
            }
            if ($search) {
                $pendaftaransRaw = $pendaftaransRaw->filter(fn($item) => 
                    stripos($item->pasien, $search) !== false || 
                    stripos($item->dokter, $search) !== false ||
                    stripos($item->poli, $search) !== false
                );
            }

            $pendaftarans = $pendaftaransRaw;
            $totalPendaftaran = $pendaftarans->count();
        }

        $months = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $today = Carbon::now();
        $tanggalCetak = $today->day . ' ' . $months[$today->month] . ' ' . $today->year;

        $periode = 'Semua Periode';
        if ($tanggalAwal && $tanggalAkhir) {
            $tglAwalFmt = Carbon::parse($tanggalAwal);
            $tglAkhirFmt = Carbon::parse($tanggalAkhir);
            $periode = 'Periode ' . $tglAwalFmt->day . ' ' . $months[$tglAwalFmt->month] . ' ' . $tglAwalFmt->year . ' - ' . $tglAkhirFmt->day . ' ' . $months[$tglAkhirFmt->month] . ' ' . $tglAkhirFmt->year;
        }

        return view('backend.admin.laporan.cetak', compact('pendaftarans', 'periode', 'totalPendaftaran', 'tanggalCetak'));
    }

    // Menampilkan halaman detail pendaftaran pasien (show)
    public function show(string $id)
    {
        // Cari pendaftaran berdasarkan NO/ID pendaftaran (dummy)
        $pendaftaran = $this->getDetailPendaftarans()->firstWhere('no', $id);

        if (!$pendaftaran) {
            abort(404, 'Data pendaftaran tidak ditemukan.');
        }

        return view('backend.admin.laporan.show', compact('pendaftaran'));
    }

    // Menampilkan cetak bukti pendaftaran pasien (print receipt)
    public function cetakBukti(string $id)
    {
        $pendaftaran = $this->getDetailPendaftarans()->firstWhere('no', $id);

        if (!$pendaftaran) {
            abort(404, 'Data pendaftaran tidak ditemukan.');
        }

        // Format tanggal daftar dalam bahasa Indonesia
        $months = [
            1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $tglDaftar = Carbon::parse($pendaftaran->tanggal);
        $tanggalDaftarFmt = $tglDaftar->day . ' ' . $months[$tglDaftar->month] . ' ' . $tglDaftar->year;

        return view('backend.admin.laporan.bukti', compact('pendaftaran', 'tanggalDaftarFmt'));
    }
}