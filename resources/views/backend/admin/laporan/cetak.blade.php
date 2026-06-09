<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Pendaftaran Pasien</title>
    <!-- Tailwind CSS & Google Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f3f4f6;
        }
        /* Penataan cetak agar pas di kertas A4 */
        @media print {
            body {
                background-color: #ffffff;
                margin: 0;
                padding: 0;
            }
            .no-print {
                display: none;
            }
            .print-container {
                box-shadow: none !important;
                border: none !important;
                margin: 0 !important;
                padding: 2cm !important;
                width: 100% !important;
                max-width: none !important;
                background: white !important;
            }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen py-10 px-4 flex justify-center">

    <!-- Container Utama Cetak Laporan (Mirip kertas A4) -->
    <div class="print-container w-full max-w-4xl bg-white border border-gray-300 rounded-xl shadow-lg p-10 flex flex-col justify-between min-h-[29.7cm]">
        
        <div class="space-y-8">
            <!-- Header Dokumen Laporan (Kop Surat Laporan) -->
            <div class="text-center relative">
                <!-- Logo Printer Kustom -->
                <img src="{{ asset('assets/images/printer.png') }}" class="h-16 w-auto mx-auto mb-4" alt="Logo Printer">
                <h1 class="text-2xl font-bold text-gray-900 tracking-wider font-semibold">LAPORAN PENDAFTARAN PASIEN</h1>
                <h2 class="text-xl font-bold text-gray-800 tracking-wide mt-1">KLINIK TADIKA MESRA</h2>
                <p class="text-sm text-gray-500 mt-2 font-medium">{{ $periode }}</p>
                <!-- Garis Ganda Pembatas Kop Laporan -->
                <div class="border-b-4 border-double border-gray-800 mt-5"></div>
            </div>

            <!-- Tabel Data Pendaftaran (Grid Boxy persis mockup) -->
            <div class="space-y-2">
                <!-- Headers Grid (5 Kolom - Tanpa Kolom Aksi) -->
                <div class="grid grid-cols-5 gap-2 text-center text-gray-800 font-bold text-sm">
                    <div class="bg-white border border-gray-300 rounded-lg p-3">No</div>
                    <div class="bg-white border border-gray-300 rounded-lg p-3">Tanggal</div>
                    <div class="bg-white border border-gray-300 rounded-lg p-3 text-left">Pasien</div>
                    <div class="bg-white border border-gray-300 rounded-lg p-3 text-left">Dokter</div>
                    <div class="bg-white border border-gray-300 rounded-lg p-3 text-left">Poli</div>
                </div>

                <!-- Rows Data Grid -->
                @forelse ($pendaftarans as $pendaftaran)
                    <div class="grid grid-cols-5 gap-2 text-center items-center text-gray-700 text-sm">
                        <!-- No -->
                        <div class="bg-white border border-gray-300 rounded-lg p-3 font-semibold">{{ $pendaftaran->no }}</div>
                        <!-- Tanggal -->
                        <div class="bg-white border border-gray-300 rounded-lg p-3">{{ \Carbon\Carbon::parse($pendaftaran->tanggal)->format('d-m-Y') }}</div>
                        <!-- Pasien -->
                        <div class="bg-white border border-gray-300 rounded-lg p-3 text-left font-medium">{{ $pendaftaran->pasien }}</div>
                        <!-- Dokter -->
                        <div class="bg-white border border-gray-300 rounded-lg p-3 text-left">{{ $pendaftaran->dokter }}</div>
                        <!-- Poli -->
                        <div class="bg-white border border-gray-300 rounded-lg p-3 text-left">{{ $pendaftaran->poli }}</div>
                    </div>
                @empty
                    <div class="text-center py-6 text-gray-500 bg-white border border-gray-300 rounded-lg">
                        Tidak ada data pendaftaran pada periode ini.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Bagian Ringkasan Bawah & Tanggal Cetak Dokumen -->
        <div class="flex flex-col space-y-2 border-t border-gray-200 pt-6 mt-8">
            <div class="text-sm font-bold text-gray-800">
                Total Pendaftaran : {{ $totalPendaftaran }}
            </div>
            <div class="text-sm text-gray-500 font-medium">
                Dicetak pada : {{ $tanggalCetak }}
            </div>
        </div>

    </div>

    <!-- Script JavaScript untuk Memicu Cetak Browser Otomatis saat Halaman Siap -->
    <script>
        window.onload = function() {
            // Beri sedikit jeda agar semua rendering gambar/font selesai, lalu jalankan menu print
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>

</body>
</html>
