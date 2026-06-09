@extends('backend.admin.layouts.app')

@section('title', 'Master Data Poliklinik - Klinik Tadika Mesra')

@section('content')
<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-6">

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg text-sm" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Header & Pencarian -->
    <form action="{{ route('admin.poliklinik.index') }}" method="GET" class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 border-b border-gray-100 pb-4">
        <div>
            <!-- Tombol Tambah (Hijau dengan icon tambah.png) -->
            <a href="{{ route('admin.poliklinik.create') }}" 
                class="inline-flex items-center px-4 py-2 bg-[#10b981] hover:bg-[#059669] text-white font-bold rounded-lg text-sm transition-colors shadow-sm active:scale-[0.98]">
                <img src="{{ asset('assets/images/tambah.png') }}" class="w-3.5 h-3.5 mr-1.5 object-contain brightness-0 invert" alt="">
                Tambah
            </a>
        </div>
        
        <!-- Kolom Search -->
        <div class="flex items-center space-x-2">
            <label for="search" class="text-sm font-semibold text-gray-700">Search:</label>
            <input type="text" name="search" id="search" value="{{ $search }}" placeholder="Cari poliklinik/deskripsi..."
                class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white">
            @if($search)
                <a href="{{ route('admin.poliklinik.index') }}" class="text-xs text-red-500 hover:underline">Clear</a>
            @endif
        </div>
    </form>

    <!-- Judul Halaman -->
    <div>
        <h1 class="text-lg font-bold text-gray-800">Poliklinik</h1>
    </div>

    <!-- Tabel Grid Poliklinik (Boxy Format) -->
    <div class="border border-gray-200 rounded-lg p-5 bg-white">
        <div class="space-y-2">
            <!-- Headers Grid (12 Kolom Terbagi) -->
            <div class="grid grid-cols-12 gap-2 text-center text-gray-700 font-bold text-sm">
                <div class="bg-white border border-gray-200 rounded-lg p-3 col-span-1">No</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 text-left col-span-3">Nama Poli</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 text-left col-span-5">Deskripsi</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 col-span-3">Aksi</div>
            </div>

            <!-- Rows Data Grid -->
            @php $no = 1; @endphp
            @forelse ($polikliniks as $poliklinik)
                <div class="grid grid-cols-12 gap-2 text-center items-center text-gray-600 text-sm">
                    <!-- No -->
                    <div class="bg-white border border-gray-200 rounded-lg p-3 font-semibold col-span-1">{{ $no++ }}</div>
                    
                    <!-- Nama Poli -->
                    <div class="bg-white border border-gray-200 rounded-lg p-3 text-left font-medium col-span-3">{{ $poliklinik['nama_poli'] }}</div>
                    
                    <!-- Deskripsi -->
                    <div class="bg-white border border-gray-200 rounded-lg p-3 text-left col-span-5 truncate" title="{{ $poliklinik['deskripsi'] }}">{{ $poliklinik['deskripsi'] }}</div>
                    
                    <!-- Aksi (Edit & Hapus) -->
                    <div class="bg-white border border-gray-200 rounded-lg p-2.5 flex items-center justify-center space-x-2 col-span-3">
                        <!-- Edit Button (Biru dengan icon edit.png) -->
                        <a href="{{ route('admin.poliklinik.edit', $poliklinik['id']) }}" 
                            class="inline-flex items-center px-3 py-1 bg-[#2563eb] hover:bg-[#1d4ed8] text-white text-xs font-bold rounded shadow-sm transition-colors">
                            <img src="{{ asset('assets/images/edit.png') }}" class="w-3.5 h-3.5 mr-1 object-contain brightness-0 invert" alt="">
                            Edit
                        </a>
                        
                        <!-- Hapus Button (Red Form) -->
                        <form action="{{ route('admin.poliklinik.destroy', $poliklinik['id']) }}" method="POST" 
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus data poliklinik ini?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="inline-flex items-center px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-bold rounded shadow-sm transition-colors">
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
                <div class="text-center py-6 text-gray-500 bg-white border border-gray-200 rounded-lg col-span-12">
                    Tidak ada data poliklinik ditemukan.
                </div>
            @endforelse
        </div>

        <!-- Footer Ringkasan & Pagination Mockup -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mt-6">
            <div class="text-sm font-bold text-gray-700">
                Total Poliklinik : {{ $polikliniks->count() }}
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
