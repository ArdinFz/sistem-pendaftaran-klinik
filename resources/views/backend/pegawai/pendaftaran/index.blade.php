@extends('backend.admin.layouts.app')

@section('title', 'Data Pendaftaran - Klinik Tadika Mesra')

@section('content')
<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-6">

    <!-- Header & Pencarian -->
    <form action="{{ route('pegawai.pendaftaran.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-gray-100 pb-4">
        <div>
            <!-- Judul Halaman -->
            <h1 class="text-xl font-bold text-gray-800">Data Pendaftaran</h1>
        </div>
        
        <!-- Kolom Search -->
        <div class="flex items-center space-x-2">
            <label for="search" class="text-sm font-semibold text-gray-700">Search:</label>
            <input type="text" name="search" id="search" value="{{ $search }}" placeholder="Cari nama/poli/dokter..."
                class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white">
            @if($search)
                <a href="{{ route('pegawai.pendaftaran.index') }}" class="text-xs text-red-500 hover:underline">Clear</a>
            @endif
        </div>
    </form>

    <!-- Tabel Grid Pendaftaran (Boxy Format) -->
    <div class="border border-gray-200 rounded-lg p-5 bg-white">
        <div class="space-y-2">
            <!-- Headers Grid (12 Kolom Terbagi) -->
            <div class="grid grid-cols-12 gap-2 text-center text-gray-700 font-bold text-sm">
                <div class="bg-white border border-gray-200 rounded-lg p-3 col-span-2">Nomor Antrean</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 text-left col-span-2">Nama Pasien</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 text-left col-span-2">Poli</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 text-left col-span-2">Dokter</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 col-span-2">Jam</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 col-span-2">Status</div>
            </div>

            <!-- Rows Data Grid -->
            @forelse ($pendaftarans as $item)
                <div class="grid grid-cols-12 gap-2 text-center items-center text-gray-600 text-sm">
                    <!-- Nomor Antrean -->
                    <div class="bg-white border border-gray-200 rounded-lg p-3 font-semibold col-span-2">{{ $item['nomor_antrean'] }}</div>
                    
                    <!-- Nama Pasien -->
                    <div class="bg-white border border-gray-200 rounded-lg p-3 text-left font-medium col-span-2 flex items-center space-x-2">
                        <div class="w-6 h-6 rounded-full bg-teal-50 flex items-center justify-center border border-gray-200 text-teal-600 font-bold text-[10px]">
                            {{ strtoupper(substr($item['pasien'], 0, 1)) }}
                        </div>
                        <span class="truncate" title="{{ $item['pasien'] }}">{{ $item['pasien'] }}</span>
                    </div>
                    
                    <!-- Poli -->
                    <div class="bg-white border border-gray-200 rounded-lg p-3 text-left col-span-2 truncate" title="{{ $item['poli'] }}">{{ $item['poli'] }}</div>

                    <!-- Dokter -->
                    <div class="bg-white border border-gray-200 rounded-lg p-3 text-left col-span-2 truncate" title="{{ $item['dokter'] }}">{{ $item['dokter'] }}</div>
                    
                    <!-- Jam -->
                    <div class="bg-white border border-gray-200 rounded-lg p-3 col-span-2 font-semibold">{{ $item['jam'] }}</div>
                    
                    <!-- Status Badge -->
                    <div class="bg-white border border-gray-200 rounded-lg p-2.5 col-span-2 flex items-center justify-center">
                        @if ($item['status'] === 'Dipanggil')
                            <span class="inline-flex items-center px-3 py-1 bg-[#002d33] text-white text-xs font-bold rounded-lg shadow-sm">
                                <!-- Spark/Pulse SVG Icon -->
                                <svg class="w-3.5 h-3.5 mr-1.5 text-teal-300 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m11.314 11.314l.707-.707M12 8a4 4 0 100 8 4 4 0 000-8z" />
                                </svg>
                                Dipanggil
                            </span>
                        @elseif ($item['status'] === 'Menunggu')
                            <span class="inline-flex items-center px-3 py-1 bg-gray-100 border border-gray-200 text-gray-600 text-xs font-bold rounded-lg shadow-sm">
                                <!-- Clock SVG Icon -->
                                <svg class="w-3.5 h-3.5 mr-1.5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Menunggu
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 bg-green-600 text-white text-xs font-bold rounded-lg shadow-sm">
                                <!-- Checkmark SVG Icon -->
                                <svg class="w-3.5 h-3.5 mr-1.5 text-green-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Selesai
                            </span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-6 text-gray-500 bg-white border border-gray-200 rounded-lg col-span-12 animate-pulse">
                    Tidak ada data pendaftaran ditemukan.
                </div>
            @endforelse
        </div>

        <!-- Footer Ringkasan & Pagination Mockup -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mt-6">
            <div class="text-sm font-bold text-gray-700">
                Total Pendaftaran : {{ $pendaftarans->count() }}
            </div>

            <div class="flex justify-end">
                <nav class="inline-flex rounded-md shadow-sm border border-gray-200 text-xs">
                    <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-white rounded-l-md border-r border-gray-200 cursor-not-allowed">Previous</span>
                    <span class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 border-r border-gray-200">1</span>
                    <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-white rounded-r-md cursor-not-allowed">Next</span>
                </nav>
            </div>
        </div>
    </div>

</div>
@endsection
