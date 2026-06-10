@extends('backend.admin.layouts.app')

@section('title', 'Beranda Pegawai - Klinik Tadika Mesra')

@section('content')
<div class="space-y-6">

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg text-sm shadow-sm" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg text-sm shadow-sm" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <!-- Welcome Banner (Sage Green) -->
    <div class="bg-[#93b4ad] rounded-xl p-6 border border-[#83a49d] shadow-sm text-teal-950">
        <h1 class="text-2xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}!</h1>
        <p class="text-sm font-medium opacity-90">
            Pegawai yang berbentuk {{ strtolower(Auth::user()->name) }}? Pasti enak tuh! Pasien ketemu ni pegawai malah ngilerrrr bleber bleber
        </p>
    </div>

    <!-- Stats Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Total Antrean Card -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 text-center">
            <h2 class="text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Total Antrean Hari Ini</h2>
            <div class="text-6xl font-extrabold text-gray-800 tracking-tight">{{ $total }}</div>
        </div>

        <!-- Antrean Menunggu Card -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 text-center flex flex-col justify-between items-center min-h-[140px]">
            <h2 class="text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Antrean Menunggu</h2>
            <div class="text-6xl font-extrabold text-gray-800 tracking-tight leading-none">{{ $menunggu }}</div>
            <div class="text-xs text-gray-500 mt-2 font-medium">Sedang dilayani</div>
        </div>

        <!-- Antrean Selesai Card -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 text-center flex flex-col justify-between items-center min-h-[140px]">
            <h2 class="text-sm font-bold text-gray-700 uppercase tracking-wider mb-2">Antrean Selesai</h2>
            <div class="text-6xl font-extrabold text-gray-800 tracking-tight leading-none">{{ $selesai }}</div>
            <div class="text-xs text-gray-500 mt-2 font-medium">Selesai hari ini</div>
        </div>
    </div>

    <!-- Antrean Hari Ini Box (Grid Table) -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-6">
        <div class="flex items-center justify-between border-b border-gray-100 pb-4">
            <h2 class="text-xl font-bold text-gray-800">Antrean Hari Ini</h2>
            
            <!-- Tombol Refresh (Teal outline & premium hover) -->
            <a href="{{ route('pegawai.dashboard.refresh') }}" 
               class="inline-flex items-center px-4 py-2 bg-white hover:bg-teal-50 border border-teal-600 hover:border-teal-700 text-teal-700 hover:text-teal-800 text-sm font-bold rounded-lg transition-all shadow-sm">
                <!-- Refresh SVG Icon -->
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                </svg>
                Refresh
            </a>
        </div>

        <div class="border border-gray-200 rounded-lg p-5 bg-white space-y-2">
            <!-- Headers Grid (12 Kolom Terbagi) -->
            <div class="grid grid-cols-12 gap-2 text-center text-gray-700 font-bold text-sm">
                <div class="bg-white border border-gray-200 rounded-lg p-3 col-span-1">Nomor Antrean</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 text-left col-span-2">Nama Pasien</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 text-left col-span-2">Poli</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 text-left col-span-2">Dokter</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 col-span-1">Jam</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 col-span-2">Status</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 col-span-2">Aksi</div>
            </div>

            <!-- Rows Data Grid -->
            @forelse ($antreans as $item)
                <div class="grid grid-cols-12 gap-2 text-center items-center text-gray-600 text-sm">
                    <!-- Nomor Antrean -->
                    <div class="bg-white border border-gray-200 rounded-lg p-3 font-semibold col-span-1">{{ $item['nomor_antrean'] }}</div>
                    
                    <!-- Nama Pasien -->
                    <div class="bg-white border border-gray-200 rounded-lg p-3 text-left font-medium col-span-2">
                        <span class="truncate" title="{{ $item['pasien'] }}">{{ $item['pasien'] }}</span>
                    </div>
                    
                    <!-- Poli -->
                    <div class="bg-white border border-gray-200 rounded-lg p-3 text-left col-span-2 truncate" title="{{ $item['poli'] }}">{{ $item['poli'] }}</div>

                    <!-- Dokter -->
                    <div class="bg-white border border-gray-200 rounded-lg p-3 text-left col-span-2 truncate" title="{{ $item['dokter'] }}">{{ $item['dokter'] }}</div>
                    
                    <!-- Jam -->
                    <div class="bg-white border border-gray-200 rounded-lg p-3 col-span-1 font-semibold">{{ $item['jam'] }}</div>
                    
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
                    
                    <!-- Aksi (Panggil & Selesai) -->
                    <div class="bg-white border border-gray-200 rounded-lg p-2.5 flex items-center justify-center space-x-1.5 col-span-2 font-medium">
                        
                        <!-- Panggil Button -->
                        @if ($item['status'] === 'Menunggu')
                            <form action="{{ route('pegawai.dashboard.panggil', $item['id']) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="inline-flex items-center px-2.5 py-1 bg-[#2563eb] hover:bg-[#1d4ed8] text-white text-[11px] font-bold rounded shadow-sm transition-colors">
                                    Panggil
                                </button>
                            </form>
                        @else
                            <button type="button" disabled 
                                    class="inline-flex items-center px-2.5 py-1 bg-gray-200 text-gray-400 text-[11px] font-bold rounded cursor-not-allowed">
                                Panggil
                            </button>
                        @endif
                        
                        <!-- Selesai Button -->
                        @if ($item['status'] === 'Menunggu' || $item['status'] === 'Dipanggil')
                            <form action="{{ route('pegawai.dashboard.selesai', $item['id']) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="inline-flex items-center px-2.5 py-1 bg-[#10b981] hover:bg-[#059669] text-white text-[11px] font-bold rounded shadow-sm transition-colors">
                                    Selesai
                                </button>
                            </form>
                        @else
                            <button type="button" disabled 
                                    class="inline-flex items-center px-2.5 py-1 bg-gray-200 text-gray-400 text-[11px] font-bold rounded cursor-not-allowed">
                                Selesai
                            </button>
                        @endif

                    </div>
                </div>
            @empty
                <div class="text-center py-6 text-gray-500 bg-white border border-gray-200 rounded-lg">
                    Tidak ada antrean hari ini.
                </div>
            @endforelse
        </div>

        <!-- Footer Ringkasan & Pagination Mockup -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mt-6">
            <div class="text-sm font-bold text-gray-700">
                Menampilkan 1 - {{ $antreans->count() }} dari {{ $antreans->count() }} antrean
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
