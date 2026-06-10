@extends('backend.admin.layouts.app')

@section('title', 'Data Pendaftaran - Klinik Tadika Mesra')

@section('content')
<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-6">

    <!-- Form Pencarian & Penyaringan -->
    <form action="{{ route('pegawai.pendaftaran.index') }}" method="GET" class="space-y-4">
        <!-- Baris Atas: Judul dan Search -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-gray-100 pb-4">
            <h1 class="text-xl font-bold text-gray-800">Data Pendaftaran</h1>
            
            <!-- Kolom Search -->
            <div class="flex items-center space-x-2">
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <!-- Search Icon -->
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" name="search" id="search" value="{{ $search }}" placeholder="Cari nama pasien..."
                        class="pl-9 pr-4 py-2 w-64 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white text-gray-700 shadow-sm">
                </div>
                @if($search || $tanggalAwal !== '2026-05-08' || $tanggalAkhir !== '2026-05-09' || $selectedPoli || $selectedDokter)
                    <a href="{{ route('pegawai.pendaftaran.index') }}" class="text-xs text-red-500 hover:underline">Clear</a>
                @endif
            </div>
        </div>

        <!-- Baris Bawah: Rentang Tanggal, Poli, Dokter, & Tombol Filter -->
        <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
            <div class="flex flex-wrap items-center gap-3 w-full">
                <!-- Rentang Tanggal -->
                <div class="flex items-center space-x-2 bg-white border border-gray-300 rounded-lg px-3 py-1.5 shadow-sm">
                    <!-- Calendar Icon -->
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <input type="date" name="tanggal_awal" value="{{ $tanggalAwal }}" class="text-sm bg-transparent outline-none border-none text-gray-700 w-36 focus:ring-0">
                    <span class="text-gray-400 font-bold">-</span>
                    <input type="date" name="tanggal_akhir" value="{{ $tanggalAkhir }}" class="text-sm bg-transparent outline-none border-none text-gray-700 w-36 focus:ring-0">
                </div>

                <!-- Dropdown Poli -->
                <select name="poli" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white text-gray-700 min-w-[160px] shadow-sm">
                    <option value="">Semua Poli</option>
                    @foreach($polikliniks as $p)
                        <option value="{{ $p['nama_poli'] }}" {{ $selectedPoli == $p['nama_poli'] ? 'selected' : '' }}>{{ $p['nama_poli'] }}</option>
                    @endforeach
                </select>

                <!-- Dropdown Dokter -->
                <select name="dokter" class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white text-gray-700 min-w-[180px] shadow-sm">
                    <option value="">Semua Dokter</option>
                    @foreach($dokters as $d)
                        <option value="{{ $d['name'] }}" {{ $selectedDokter == $d['name'] ? 'selected' : '' }}>{{ $d['name'] }}</option>
                    @endforeach
                </select>

                <!-- Filter Submit Button -->
                <button type="submit" class="px-4 py-2 bg-[#005960] hover:bg-[#00474d] text-white text-sm font-bold rounded-lg shadow-sm transition-colors">
                    Filter
                </button>
            </div>
        </div>
    </form>

    <!-- Tabel Pendaftaran (Scrollable & Boxy Grid) -->
    <div class="border border-gray-200 rounded-lg p-5 bg-white">
        <div class="overflow-x-auto">
            <table class="w-full border-separate" style="border-spacing: 4px 8px;">
                <thead>
                    <tr class="text-gray-700 font-bold text-sm">
                        <th class="bg-white border border-gray-200 rounded-lg p-3 text-center whitespace-nowrap min-w-[50px]">No</th>
                        <th class="bg-white border border-gray-200 rounded-lg p-3 text-center whitespace-nowrap min-w-[120px]">Tanggal Daftar</th>
                        <th class="bg-white border border-gray-200 rounded-lg p-3 text-center whitespace-nowrap min-w-[100px]">Hari</th>
                        <th class="bg-white border border-gray-200 rounded-lg p-3 text-center whitespace-nowrap min-w-[80px]">Jam</th>
                        <th class="bg-white border border-gray-200 rounded-lg p-3 text-left whitespace-nowrap min-w-[150px]">NIK</th>
                        <th class="bg-white border border-gray-200 rounded-lg p-3 text-left whitespace-nowrap min-w-[240px]">Email / No. Hp</th>
                        <th class="bg-white border border-gray-200 rounded-lg p-3 text-left whitespace-nowrap min-w-[180px]">Pasien</th>
                        <th class="bg-white border border-gray-200 rounded-lg p-3 text-left whitespace-nowrap min-w-[180px]">Dokter</th>
                        <th class="bg-white border border-gray-200 rounded-lg p-3 text-left whitespace-nowrap min-w-[150px]">Poli</th>
                        <th class="bg-white border border-gray-200 rounded-lg p-3 text-center whitespace-nowrap min-w-[100px]">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pendaftarans as $index => $item)
                        <tr class="text-gray-600 text-sm">
                            <td class="bg-white border border-gray-200 rounded-lg p-3 text-center font-semibold">{{ $index + 1 }}</td>
                            <td class="bg-white border border-gray-200 rounded-lg p-3 text-center font-medium">{{ \Carbon\Carbon::parse($item['tanggal'])->format('d-m-Y') }}</td>
                            <td class="bg-white border border-gray-200 rounded-lg p-3 text-center">{{ $item['hari'] }}</td>
                            <td class="bg-white border border-gray-200 rounded-lg p-3 text-center font-semibold">{{ $item['jam'] }}</td>
                            <td class="bg-white border border-gray-200 rounded-lg p-3 text-left font-mono">{{ $item['nik'] }}</td>
                            <td class="bg-white border border-gray-200 rounded-lg p-3 text-left">{{ $item['email'] }} / {{ $item['no_hp'] }}</td>
                            <td class="bg-white border border-gray-200 rounded-lg p-3 text-left font-semibold text-gray-800">
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 rounded-full bg-teal-50 flex items-center justify-center border border-gray-200 text-teal-600 font-bold text-[10px]">
                                        {{ strtoupper(substr($item['pasien'], 0, 1)) }}
                                    </div>
                                    <span>{{ $item['pasien'] }}</span>
                                </div>
                            </td>
                            <td class="bg-white border border-gray-200 rounded-lg p-3 text-left">{{ $item['dokter'] }}</td>
                            <td class="bg-white border border-gray-200 rounded-lg p-3 text-left">{{ $item['poli'] }}</td>
                            <td class="bg-white border border-gray-200 rounded-lg p-3 text-center">
                                <a href="{{ route('pegawai.pendaftaran.show', $item['no']) }}" 
                                   class="inline-flex items-center px-4 py-1.5 bg-[#005960] hover:bg-[#00474d] text-white text-[11px] font-bold rounded shadow-sm transition-colors">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center py-6 text-gray-500 bg-white border border-gray-200 rounded-lg">
                                Tidak ada data pendaftaran ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
