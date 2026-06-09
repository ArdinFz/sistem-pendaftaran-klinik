@extends('backend.admin.layouts.app')

@section('title', 'Dashboard Admin - Klinik Tadika Mesra')

@section('content')
<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-6">
    
    <!-- Welcome Alert Banner -->
    <div class="bg-[#8faea8] text-[#1e3f3b] p-5 rounded-lg shadow-sm">
        <h1 class="text-2xl font-bold mb-1">Selamat Datang, {{ $adminName }}!</h1>
        <p class="text-sm opacity-90">Cieee admin sistem ini, situ orang ato makanan?</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Card Total Pasien -->
        <div class="bg-white border border-gray-200 rounded-lg p-6 text-center shadow-sm hover:shadow-md transition-shadow">
            <h3 class="text-xl font-bold text-gray-700 mb-2">Total Pasien</h3>
            <p class="text-6xl font-extrabold text-[#005960]">{{ $totalPasien }}</p>
        </div>

        <!-- Card Total Dokter -->
        <div class="bg-white border border-gray-200 rounded-lg p-6 text-center shadow-sm hover:shadow-md transition-shadow">
            <h3 class="text-xl font-bold text-gray-700 mb-2">Total Dokter</h3>
            <p class="text-6xl font-extrabold text-[#005960]">{{ $totalDokter }}</p>
        </div>

        <!-- Card Pendaftaran Hari Ini -->
        <div class="bg-white border border-gray-200 rounded-lg p-6 text-center shadow-sm hover:shadow-md transition-shadow">
            <h3 class="text-xl font-bold text-gray-700 mb-2">Total Pendaftaran Hari Ini</h3>
            <p class="text-6xl font-extrabold text-[#005960]">{{ $totalPendaftaranHariIni }}</p>
        </div>
    </div>

    <!-- Tabel Box Antrean Hari Ini -->
    <div class="border border-gray-200 rounded-lg p-5 bg-white">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Antrean Hari Ini</h2>

        <!-- CSS Grid Tabel Boxy -->
        <div class="space-y-2">
            <!-- Table Headers -->
            <div class="grid grid-cols-6 gap-2 text-center text-gray-700 font-bold text-sm">
                <div class="bg-white border border-gray-200 rounded-lg p-3">Nomor Antrean</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 text-left">Nama Pasien</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 text-left">Poli</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 text-left">Dokter</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3">Jam</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3">Status</div>
            </div>

            <!-- Data Rows -->
            @foreach ($antreans as $antrean)
            <div class="grid grid-cols-6 gap-2 text-center items-center text-gray-600 text-sm">
                <div class="bg-white border border-gray-200 rounded-lg p-3 font-semibold">{{ $antrean->nomor_antrean }}</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 text-left font-medium">{{ $antrean->nama_pasien }}</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 text-left">{{ $antrean->poli }}</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 text-left">{{ $antrean->dokter }}</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 font-medium">{{ $antrean->jam }}</div>
                <div class="bg-white border border-gray-200 rounded-lg p-2.5 flex items-center justify-center">
                    @if ($antrean->status === 'Dipanggil')
                        <span class="inline-flex items-center px-3 py-1 rounded bg-[#0f3a43] text-white text-xs font-semibold">
                            <svg class="w-3.5 h-3.5 mr-1 text-teal-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-11.314l.707.707m11.314 11.314l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                            </svg>
                            Dipanggil
                        </span>
                    @elseif ($antrean->status === 'Menunggu')
                        <span class="inline-flex items-center px-3 py-1 rounded bg-[#8b9196] text-white text-xs font-semibold">
                            <svg class="w-3.5 h-3.5 mr-1 text-gray-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Menunggu
                        </span>
                    @elseif ($antrean->status === 'Selesai')
                        <span class="inline-flex items-center px-3 py-1 rounded bg-[#0ea855] text-white text-xs font-semibold">
                            <svg class="w-3.5 h-3.5 mr-1 text-green-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Selesai
                        </span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="flex justify-end mt-4">
            <nav class="inline-flex rounded-md shadow-sm border border-gray-200">
                <a href="#" class="px-3 py-2 text-sm font-medium text-gray-400 bg-white rounded-l-md hover:bg-gray-50 border-r border-gray-200">Previous</a>
                <a href="#" class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 border-r border-gray-200">1</a>
                <a href="#" class="px-3 py-2 text-sm font-medium text-gray-500 bg-white rounded-r-md hover:bg-gray-50">Next</a>
            </nav>
        </div>

    </div>

</div>
@endsection