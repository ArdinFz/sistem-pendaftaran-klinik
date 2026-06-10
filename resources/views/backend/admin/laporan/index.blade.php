@extends('backend.admin.layouts.app')

@section('title', 'Laporan Pendaftaran - Klinik Tadika Mesra')

@section('content')
<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-6">
    
    <!-- Formulir Filter & Pencarian Terpadu -->
    <form action="{{ route('admin.laporan.index') }}" method="GET" class="space-y-4">
        
        <!-- Header Laporan & Kolom Search -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-gray-100 pb-4">
            <h1 class="text-xl font-bold text-gray-800">Laporan Pendaftaran Pasien Klinik Tadika Mesra</h1>
            
            <!-- Input Search -->
            <div class="flex items-center space-x-2">
                <label for="search" class="text-sm font-semibold text-gray-700">Search:</label>
                <input type="text" name="search" id="search" value="{{ $search }}" placeholder="Cari nama/dokter/poli..."
                    class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white">
                @if($search)
                    <a href="{{ route('admin.laporan.index', ['tanggal_awal' => $tanggalAwal, 'tanggal_akhir' => $tanggalAkhir]) }}" class="text-xs text-red-500 hover:underline">Clear</a>
                @endif
            </div>
        </div>

        <!-- Kolom Tanggal Awal, Tanggal Akhir & Tombol Aksi -->
        <div class="flex flex-col md:flex-row md:items-end gap-4">
            <!-- Tanggal Awal -->
            <div>
                <label for="tanggal_awal" class="block text-sm font-bold text-gray-700 mb-1.5">Tanggal Awal :</label>
                <input type="date" name="tanggal_awal" id="tanggal_awal" value="{{ $tanggalAwal }}"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white">
            </div>

            <!-- Tanggal Akhir -->
            <div>
                <label for="tanggal_akhir" class="block text-sm font-bold text-gray-700 mb-1.5">Tanggal Akhir :</label>
                <input type="date" name="tanggal_akhir" id="tanggal_akhir" value="{{ $tanggalAkhir }}"
                    class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white">
            </div>

            <!-- Tombol Tampilkan & Cetak -->
            <div class="flex items-center space-x-3">
                <!-- Tombol Tampilkan (Hijau) -->
                <button type="submit" 
                    class="inline-flex items-center px-4 py-2 bg-[#10b981] hover:bg-[#059669] text-white font-bold rounded-lg text-sm transition-colors shadow-sm">
                    Tampilkan
                </button>

                <!-- Tombol Cetak (Biru - Membuka Tab Cetak Baru) -->
                <a href="{{ route('admin.laporan.cetak', ['tanggal_awal' => $tanggalAwal, 'tanggal_akhir' => $tanggalAkhir, 'search' => $search]) }}" 
                    target="_blank"
                    class="inline-flex items-center px-4 py-2 bg-[#2563eb] hover:bg-[#1d4ed8] text-white font-bold rounded-lg text-sm transition-colors shadow-sm">
                    <!-- Icon Print Kustom (printer.png) -->
                    <img src="{{ asset('assets/images/printer.png') }}" class="w-4 h-4 mr-1.5 object-contain brightness-0 invert" alt="">
                    Cetak
                </a>
            </div>
        </div>

    </form>

    <!-- Tabel Laporan Pendaftaran (Format Boxy) -->
    <div class="border border-gray-200 rounded-lg p-5 bg-white">
        <div class="overflow-x-auto">
            <div class="space-y-2 min-w-[850px]">
                <!-- Table Headers -->
                <div class="grid grid-cols-6 gap-2 text-center text-gray-700 font-bold text-sm">
                    <div class="bg-white border border-gray-200 rounded-lg p-3">No</div>
                    <div class="bg-white border border-gray-200 rounded-lg p-3">Tanggal</div>
                    <div class="bg-white border border-gray-200 rounded-lg p-3 text-left">Pasien</div>
                    <div class="bg-white border border-gray-200 rounded-lg p-3 text-left">Dokter</div>
                    <div class="bg-white border border-gray-200 rounded-lg p-3 text-left">Poli</div>
                    <div class="bg-white border border-gray-200 rounded-lg p-3">Aksi</div>
                </div>

                <!-- Data Rows -->
                @forelse ($pendaftarans as $pendaftaran)
                    <div class="grid grid-cols-6 gap-2 text-center items-center text-gray-600 text-sm">
                        <!-- No -->
                        <div class="bg-white border border-gray-200 rounded-lg p-3 font-semibold">{{ $pendaftaran->no }}</div>
                        
                        <!-- Tanggal -->
                        <div class="bg-white border border-gray-200 rounded-lg p-3">{{ \Carbon\Carbon::parse($pendaftaran->tanggal)->format('d-m-Y') }}</div>
                        
                        <!-- Pasien -->
                        <div class="bg-white border border-gray-200 rounded-lg p-3 text-left font-medium">{{ $pendaftaran->pasien }}</div>
                        
                        <!-- Dokter -->
                        <div class="bg-white border border-gray-200 rounded-lg p-3 text-left">{{ $pendaftaran->dokter }}</div>
                        
                        <!-- Poli -->
                        <div class="bg-white border border-gray-200 rounded-lg p-3 text-left">{{ $pendaftaran->poli }}</div>
                        
                        <!-- Aksi (Detail) -->
                        <div class="bg-white border border-gray-200 rounded-lg p-2.5 flex items-center justify-center">
                            <a href="{{ route('admin.laporan.show', $pendaftaran->no) }}" class="inline-flex items-center px-3.5 py-1 bg-[#0d9488] hover:bg-[#0f766e] text-white text-xs font-bold rounded shadow-sm transition-colors">
                                Detail
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6 text-gray-500 bg-white border border-gray-200 rounded-lg col-span-6">
                        Tidak ada data pendaftaran pada periode ini.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Footer Ringkasan & Pagination -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mt-6">
            <!-- Total Pendaftaran -->
            <div class="text-sm font-bold text-gray-700">
                Total Pendaftaran : {{ $totalPendaftaran }}
            </div>

            <!-- Pagination (Jika tipe collection, Laravel links() bisa diganti navigasi manual atau biarkan saja) -->
            @if(method_exists($pendaftarans, 'links'))
                <div>
                    {{ $pendaftarans->links() }}
                </div>
            @else
                <div class="flex justify-end">
                    <nav class="inline-flex rounded-md shadow-sm border border-gray-200 text-xs">
                        <a href="#" class="px-3 py-2 text-sm font-medium text-gray-400 bg-white rounded-l-md border-r border-gray-200">Previous</a>
                        <a href="#" aria-current="page" class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 border-r border-gray-200">1</a>
                        <a href="#" class="px-3 py-2 text-sm font-medium text-gray-500 bg-white rounded-r-md">Next</a>
                    </nav>
                </div>
            @endif
        </div>

    </div>

</div>
@endsection
