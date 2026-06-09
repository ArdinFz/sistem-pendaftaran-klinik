@extends('backend.admin.layouts.app')

@section('title', 'Detail Pendaftaran Pasien - Klinik Tadika Mesra')

@section('content')
<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-8">
    
    <!-- Header Page -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between pb-4 border-b border-gray-100 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Detail Pendaftaran Pasien</h1>
            <p class="text-sm text-gray-500 mt-1">Informasi lengkap data registrasi pasien dan jadwal pemeriksaan dokter.</p>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.laporan.index') }}" 
                class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-bold rounded-lg text-sm transition-colors shadow-sm active:scale-[0.98]">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
            
            <a href="{{ route('admin.laporan.cetak-bukti', $pendaftaran->no) }}" 
                target="_blank"
                class="inline-flex items-center px-4 py-2 bg-[#2563eb] hover:bg-[#1d4ed8] text-white font-bold rounded-lg text-sm transition-colors shadow-sm active:scale-[0.98]">
                <!-- Icon Printer Kustom (printer.png) -->
                <img src="{{ asset('assets/images/printer.png') }}" class="w-4 h-4 mr-1.5 object-contain brightness-0 invert" alt="">
                Cetak Bukti
            </a>
        </div>
    </div>

    <!-- Main Grid Content -->
    <div class="space-y-6">
        
        <!-- Box 1: Informasi Pendaftaran (ID, Tanggal, No Antrean) -->
        <div class="space-y-3">
            <h2 class="text-sm font-bold text-gray-700 uppercase tracking-wider">I. Informasi Pendaftaran</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- ID Pendaftaran -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <span class="block text-xs font-bold text-[#005b66] uppercase tracking-wider mb-1">ID Pendaftaran</span>
                    <span class="text-base font-semibold text-gray-800">{{ $pendaftaran->id_pendaftaran }}</span>
                </div>
                
                <!-- Tanggal Daftar -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <span class="block text-xs font-bold text-[#005b66] uppercase tracking-wider mb-1">Tanggal Daftar</span>
                    <span class="text-base font-semibold text-gray-800">{{ \Carbon\Carbon::parse($pendaftaran->tanggal)->format('d-m-Y') }}</span>
                </div>
                
                <!-- Nomor Antrean -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 flex flex-col justify-center">
                    <span class="block text-xs font-bold text-[#005b66] uppercase tracking-wider mb-1">Nomor Antrean</span>
                    <span class="text-lg font-bold text-teal-600">{{ $pendaftaran->nomor_antrean }}</span>
                </div>
            </div>
        </div>

        <!-- Box 2: Data Pasien -->
        <div class="space-y-3">
            <h2 class="text-sm font-bold text-gray-700 uppercase tracking-wider">II. Data Pasien</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Nama Pasien -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <span class="block text-xs font-bold text-[#005b66] uppercase tracking-wider mb-1">Nama Pasien</span>
                    <span class="text-base font-semibold text-gray-800">{{ $pendaftaran->pasien }}</span>
                </div>

                <!-- NIK -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <span class="block text-xs font-bold text-[#005b66] uppercase tracking-wider mb-1">NIK Pasien</span>
                    <span class="text-base font-semibold text-gray-800">{{ $pendaftaran->nik }}</span>
                </div>

                <!-- Jenis Kelamin -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <span class="block text-xs font-bold text-[#005b66] uppercase tracking-wider mb-1">Jenis Kelamin</span>
                    <span class="text-base font-semibold text-gray-800">{{ $pendaftaran->jenis_kelamin }}</span>
                </div>

                <!-- Tanggal Lahir -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <span class="block text-xs font-bold text-[#005b66] uppercase tracking-wider mb-1">Tanggal Lahir</span>
                    <span class="text-base font-semibold text-gray-800">{{ $pendaftaran->tanggal_lahir }}</span>
                </div>

                <!-- Email -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <span class="block text-xs font-bold text-[#005b66] uppercase tracking-wider mb-1">Alamat Email</span>
                    <span class="text-base font-semibold text-gray-800">{{ $pendaftaran->email }}</span>
                </div>

                <!-- No HP -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <span class="block text-xs font-bold text-[#005b66] uppercase tracking-wider mb-1">Nomor Handphone / WA</span>
                    <span class="text-base font-semibold text-gray-800">{{ $pendaftaran->no_hp }}</span>
                </div>

                <!-- Alamat (Full Width) -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 md:col-span-2">
                    <span class="block text-xs font-bold text-[#005b66] uppercase tracking-wider mb-1">Alamat Lengkap</span>
                    <span class="text-base font-semibold text-gray-800">{{ $pendaftaran->alamat }}</span>
                </div>
            </div>
        </div>

        <!-- Box 3: Data Pemeriksaan -->
        <div class="space-y-3">
            <h2 class="text-sm font-bold text-gray-700 uppercase tracking-wider">III. Data Pemeriksaan & Rencana Kunjungan</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Poliklinik -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <span class="block text-xs font-bold text-[#005b66] uppercase tracking-wider mb-1">Poliklinik Tujuan</span>
                    <span class="text-base font-semibold text-gray-800">{{ $pendaftaran->poli }}</span>
                </div>

                <!-- Dokter -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <span class="block text-xs font-bold text-[#005b66] uppercase tracking-wider mb-1">Dokter Pemeriksa</span>
                    <span class="text-base font-semibold text-gray-800">{{ $pendaftaran->dokter }}</span>
                </div>

                <!-- Hari Periksa -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <span class="block text-xs font-bold text-[#005b66] uppercase tracking-wider mb-1">Hari Kunjungan</span>
                    <span class="text-base font-semibold text-gray-800">{{ $pendaftaran->hari_periksa }}</span>
                </div>

                <!-- Jam Periksa -->
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                    <span class="block text-xs font-bold text-[#005b66] uppercase tracking-wider mb-1">Jam Sesi Kunjungan</span>
                    <span class="text-base font-semibold text-gray-800">{{ $pendaftaran->jam }}</span>
                </div>
            </div>
        </div>

        <!-- Box 4: Keluhan -->
        <div class="space-y-3">
            <h2 class="text-sm font-bold text-gray-700 uppercase tracking-wider">IV. Keluhan Klinis Pasien</h2>
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 min-h-[100px]">
                <span class="block text-xs font-bold text-[#005b66] uppercase tracking-wider mb-2">Keluhan Utama / Alasan Kunjungan</span>
                <p class="text-sm text-gray-700 leading-relaxed font-medium">
                    {{ $pendaftaran->keluhan }}
                </p>
            </div>
        </div>

    </div>

</div>
@endsection
