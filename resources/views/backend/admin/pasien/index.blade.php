@extends('backend.admin.layouts.app')

@section('title', 'Master Data Pasien - Klinik Tadika Mesra')

@section('content')
<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-6">

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg text-sm" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Header & Pencarian -->
    <form action="{{ route('admin.pasien.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-gray-100 pb-4">
        <div>
            <!-- Judul Halaman -->
            <h1 class="text-xl font-bold text-gray-800">Pasien</h1>
        </div>
        
        <!-- Kolom Search -->
        <div class="flex items-center space-x-2">
            <label for="search" class="text-sm font-semibold text-gray-700">Search:</label>
            <input type="text" name="search" id="search" value="{{ $search }}" placeholder="Cari nama/nik/alamat..."
                class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white">
            @if($search)
                <a href="{{ route('admin.pasien.index') }}" class="text-xs text-red-500 hover:underline">Clear</a>
            @endif
        </div>
    </form>

    <!-- Tabel Grid Pasien (Boxy Format) -->
    <div class="border border-gray-200 rounded-lg p-5 bg-white">
        <div class="space-y-2">
            <!-- Headers Grid (12 Kolom Terbagi) -->
            <div class="grid grid-cols-12 gap-2 text-center text-gray-700 font-bold text-sm">
                <div class="bg-white border border-gray-200 rounded-lg p-3 col-span-1">No</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 text-left col-span-2">Nama Pasien</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 text-left col-span-2">NIK</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 text-left col-span-2">Email</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 col-span-1">Tanggal Lahir</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 col-span-1">Nomor Hp</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 text-left col-span-1">Alamat</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 col-span-2">Aksi</div>
            </div>

            <!-- Rows Data Grid -->
            @forelse ($pasiens as $pasien)
                <div class="grid grid-cols-12 gap-2 text-center items-center text-gray-600 text-sm">
                    <!-- No -->
                    <div class="bg-white border border-gray-200 rounded-lg p-3 font-semibold col-span-1">{{ $pasien['no'] }}</div>
                    
                    <!-- Nama Pasien -->
                    <div class="bg-white border border-gray-200 rounded-lg p-3 text-left font-medium col-span-2 flex items-center space-x-2">
                        @if($pasien['foto'])
                            <img src="{{ asset($pasien['foto']) }}" class="w-6 h-6 rounded-full object-cover border border-gray-200" alt="">
                        @else
                            <div class="w-6 h-6 rounded-full bg-teal-50 flex items-center justify-center border border-gray-200 text-teal-600 font-bold text-[10px]">
                                {{ strtoupper(substr($pasien['name'], 0, 1)) }}
                            </div>
                        @endif
                        <span>{{ $pasien['name'] }}</span>
                    </div>
                    
                    <!-- NIK -->
                    <div class="bg-white border border-gray-200 rounded-lg p-3 text-left col-span-2">{{ $pasien['nik'] }}</div>

                    <!-- Email -->
                    <div class="bg-white border border-gray-200 rounded-lg p-3 text-left col-span-2 truncate" title="{{ $pasien['email'] ?? '' }}">{{ $pasien['email'] ?? '' }}</div>
                    
                    <!-- Tanggal Lahir -->
                    <div class="bg-white border border-gray-200 rounded-lg p-3 col-span-1">{{ \Carbon\Carbon::parse($pasien['tanggal_lahir'])->format('d M Y') }}</div>
                    
                    <!-- Nomor Hp -->
                    <div class="bg-white border border-gray-200 rounded-lg p-3 col-span-1">{{ $pasien['no_hp'] }}</div>
                    
                    <!-- Alamat -->
                    <div class="bg-white border border-gray-200 rounded-lg p-3 text-left col-span-1 truncate" title="{{ $pasien['alamat'] }}">{{ $pasien['alamat'] }}</div>
                    
                    <!-- Aksi (Edit & Hapus) -->
                    <div class="bg-white border border-gray-200 rounded-lg p-2.5 flex items-center justify-center space-x-1.5 col-span-2 font-medium">
                        <!-- Edit Button (Biru dengan icon edit.png) -->
                        <a href="{{ route('admin.pasien.edit', $pasien['id']) }}" 
                            class="inline-flex items-center px-2 py-1 bg-[#2563eb] hover:bg-[#1d4ed8] text-white text-[11px] font-bold rounded shadow-sm transition-colors">
                            <img src="{{ asset('assets/images/edit.png') }}" class="w-3 h-3 mr-1 object-contain brightness-0 invert" alt="">
                            Edit
                        </a>
                        
                        <!-- Hapus Button (Red Form) -->
                        <form action="{{ route('admin.pasien.destroy', $pasien['id']) }}" method="POST" 
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pasien ini?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="inline-flex items-center px-2 py-1 bg-red-600 hover:bg-red-700 text-white text-[11px] font-bold rounded shadow-sm transition-colors">
                                <!-- Trash Icon SVG -->
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-6 text-gray-500 bg-white border border-gray-200 rounded-lg">
                    Tidak ada data pasien ditemukan.
                </div>
            @endforelse
        </div>

        <!-- Footer Ringkasan & Pagination Mockup -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mt-6">
            <div class="text-sm font-bold text-gray-700">
                Total Pasien : {{ $pasiens->count() }}
            </div>

            <div class="flex justify-end">
                <nav class="inline-flex rounded-md shadow-sm border border-gray-200 text-xs">
                    <a href="#" class="px-3 py-2 text-sm font-medium text-gray-400 bg-white rounded-l-md border-r border-gray-200">Previous</a>
                    <a href="#" aria-current="page" class="px-4 py-2 text-sm font-semibold text-white bg-blue-600 border-r border-gray-200">1</a>
                    <a href="#" class="px-3 py-2 text-sm font-medium text-gray-500 bg-white rounded-r-md">Next</a>
                </nav>
            </div>
        </div>
    </div>

</div>
@endsection