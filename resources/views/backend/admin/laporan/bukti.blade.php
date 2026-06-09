<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Bukti Pendaftaran Pasien</title>
    <!-- Tailwind CSS & Google Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f3f4f6;
        }
        /* Penataan cetak agar pas di kertas */
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
                margin: 0 auto !important;
                padding: 1cm !important;
                width: 100% !important;
                max-width: 18cm !important;
                background: white !important;
            }
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen py-10 px-4 flex justify-center items-center">

    <!-- Container Utama Bukti Pendaftaran (Format Receipt Card) -->
    <div class="print-container w-full max-w-lg bg-white border border-gray-300 rounded-xl shadow-lg p-8 flex flex-col justify-between">
        
        <div class="space-y-6">
            <!-- Header Dokumen Bukti (Kop Surat Bukti) -->
            <div class="text-center">
                <!-- Logo Printer Kustom -->
                <img src="{{ asset('assets/images/printer.png') }}" class="h-16 w-auto mx-auto mb-3" alt="Logo Printer">
                <h1 class="text-lg font-bold text-gray-900 tracking-wider uppercase">Bukti Pendaftaran Pasien</h1>
                <h2 class="text-sm font-semibold text-gray-700 tracking-wide">Klinik Tadika Mesra</h2>
                <div class="border-b border-dashed border-gray-400 mt-4"></div>
            </div>

            <!-- Bagian Nomor Antrean Besar -->
            <div class="text-center bg-gray-50 border border-gray-200 rounded-lg py-4">
                <span class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-1">Nomor Antrean</span>
                <span class="text-4xl font-extrabold text-teal-600 tracking-tight">{{ $pendaftaran->nomor_antrean }}</span>
            </div>

            <!-- Detail Pendaftaran Pasien (Grid Boxy) -->
            <div class="space-y-3">
                <h3 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Detail Data</h3>
                
                <div class="border border-gray-200 rounded-lg divide-y divide-gray-200 text-sm">
                    <!-- ID Pendaftaran -->
                    <div class="grid grid-cols-3 p-3">
                        <span class="text-gray-500 font-semibold">ID Daftar</span>
                        <span class="col-span-2 text-gray-800 font-bold">: {{ $pendaftaran->id_pendaftaran }}</span>
                    </div>

                    <!-- Tanggal Daftar -->
                    <div class="grid grid-cols-3 p-3">
                        <span class="text-gray-500 font-semibold">Tanggal</span>
                        <span class="col-span-2 text-gray-800 font-medium">: {{ $tanggalDaftarFmt }}</span>
                    </div>

                    <!-- Nama Pasien -->
                    <div class="grid grid-cols-3 p-3">
                        <span class="text-gray-500 font-semibold">Nama Pasien</span>
                        <span class="col-span-2 text-gray-800 font-semibold">: {{ $pendaftaran->pasien }}</span>
                    </div>

                    <!-- NIK Pasien -->
                    <div class="grid grid-cols-3 p-3">
                        <span class="text-gray-500 font-semibold">NIK Pasien</span>
                        <span class="col-span-2 text-gray-800">: {{ $pendaftaran->nik }}</span>
                    </div>

                    <!-- Poliklinik -->
                    <div class="grid grid-cols-3 p-3">
                        <span class="text-gray-500 font-semibold">Poliklinik</span>
                        <span class="col-span-2 text-gray-800 font-semibold">: {{ $pendaftaran->poli }}</span>
                    </div>

                    <!-- Dokter Pemeriksa -->
                    <div class="grid grid-cols-3 p-3">
                        <span class="text-gray-500 font-semibold">Dokter</span>
                        <span class="col-span-2 text-gray-800 font-medium">: {{ $pendaftaran->dokter }}</span>
                    </div>

                    <!-- Jadwal Kunjungan -->
                    <div class="grid grid-cols-3 p-3">
                        <span class="text-gray-500 font-semibold">Jadwal</span>
                        <span class="col-span-2 text-gray-800 font-medium">: {{ $pendaftaran->hari_periksa }}, {{ $pendaftaran->jam }}</span>
                    </div>
                </div>
            </div>

            <!-- Keluhan Singkat -->
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 text-xs space-y-1">
                <span class="block font-bold text-gray-500 uppercase tracking-wider">Keluhan / Alasan Kunjungan:</span>
                <p class="text-gray-700 leading-relaxed italic">
                    "{{ $pendaftaran->keluhan }}"
                </p>
            </div>
            
            <div class="border-b border-dashed border-gray-400 mt-4"></div>
        </div>

        <!-- Bagian Footer Penutup Bukti -->
        <div class="text-center mt-6">
            <p class="text-[11px] text-gray-400 font-medium">Terima kasih telah melakukan pendaftaran online.</p>
            <p class="text-[11px] text-gray-400">Harap datang 15 menit sebelum jam sesi kunjungan dimulai.</p>
        </div>

    </div>

    <!-- Script JavaScript untuk Memicu Cetak Browser Otomatis saat Halaman Siap -->
    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>

</body>
</html>
