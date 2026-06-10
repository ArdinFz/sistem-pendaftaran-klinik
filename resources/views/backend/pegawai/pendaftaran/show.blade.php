@extends('backend.admin.layouts.app')

@section('title', 'Detail Pendaftaran Pasien - Klinik Tadika Mesra')

@section('content')
<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-6">

    <!-- Header Judul -->
    <div class="border-b border-gray-100 pb-4">
        <h1 class="text-xl font-bold text-gray-800">Detail Pendaftaran Pasien</h1>
    </div>

    <!-- Kotak 1: Info Pendaftaran -->
    <div class="border border-gray-200 rounded-lg p-5 bg-white max-w-xs shadow-sm">
        <table class="w-full text-sm text-gray-600">
            <tr>
                <td class="py-1 font-semibold pr-4">ID Pendaftaran</td>
                <td class="py-1 font-bold text-gray-800">: {{ $pendaftaran['id_pendaftaran'] }}</td>
            </tr>
            <tr>
                <td class="py-1 font-semibold pr-4">Tanggal Daftar</td>
                <td class="py-1">: {{ \Carbon\Carbon::parse($pendaftaran['tanggal'])->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td class="py-1 font-semibold pr-4">Nomor Antrean</td>
                <td class="py-1 font-bold text-teal-700">: {{ $pendaftaran['nomor_antrean'] }}</td>
            </tr>
        </table>
    </div>

    <!-- Kotak 2: Data Pasien -->
    <div class="border border-gray-200 rounded-lg p-5 bg-white shadow-sm space-y-3">
        <h2 class="text-sm font-bold text-gray-700 uppercase tracking-wider border-b border-gray-100 pb-2">Data Pasien</h2>
        <table class="w-full text-sm text-gray-600">
            <tr>
                <td class="py-1 font-semibold w-1/4">Nama Pasien</td>
                <td class="py-1 text-gray-800">: {{ $pendaftaran['pasien'] }}</td>
            </tr>
            <tr>
                <td class="py-1 font-semibold">NIK</td>
                <td class="py-1 font-mono">: {{ $pendaftaran['nik'] }}</td>
            </tr>
            <tr>
                <td class="py-1 font-semibold">Jenis Kelamin</td>
                <td class="py-1">: {{ $pendaftaran['jenis_kelamin'] }}</td>
            </tr>
            <tr>
                <td class="py-1 font-semibold">Tanggal Lahir</td>
                <td class="py-1">: {{ \Carbon\Carbon::parse($pendaftaran['tanggal_lahir'])->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td class="py-1 font-semibold">Email / No. Hp</td>
                <td class="py-1">: {{ $pendaftaran['email'] }} / {{ $pendaftaran['no_hp'] }}</td>
            </tr>
            <tr>
                <td class="py-1 font-semibold">Alamat</td>
                <td class="py-1">: {{ $pendaftaran['alamat'] }}</td>
            </tr>
        </table>
    </div>

    <!-- Kotak 3: Data Pemeriksaan -->
    <div class="border border-gray-200 rounded-lg p-5 bg-white shadow-sm space-y-3">
        <h2 class="text-sm font-bold text-gray-700 uppercase tracking-wider border-b border-gray-100 pb-2">Data Pemeriksaan</h2>
        <table class="w-full text-sm text-gray-600">
            <tr>
                <td class="py-1 font-semibold w-1/4">Poliklinik</td>
                <td class="py-1 text-gray-800">: {{ $pendaftaran['poli'] }}</td>
            </tr>
            <tr>
                <td class="py-1 font-semibold">Dokter</td>
                <td class="py-1">: {{ $pendaftaran['dokter'] }}</td>
            </tr>
            <tr>
                <td class="py-1 font-semibold">Hari Periksa</td>
                <td class="py-1">: {{ $pendaftaran['hari'] }}</td>
            </tr>
            <tr>
                <td class="py-1 font-semibold">Jam Periksa</td>
                <td class="py-1 font-semibold text-teal-800">: {{ $pendaftaran['jam'] }}</td>
            </tr>
        </table>
    </div>

    <!-- Kotak 4: Keluhan -->
    <div class="border border-gray-200 rounded-lg p-5 bg-white shadow-sm space-y-3">
        <h2 class="text-sm font-bold text-gray-700 uppercase tracking-wider border-b border-gray-100 pb-2">Keluhan</h2>
        <p class="text-sm text-gray-600 leading-relaxed bg-gray-50 rounded-lg p-4 border border-gray-100">
            {{ $pendaftaran['keluhan'] }}
        </p>
    </div>

    <!-- Tombol Kembali (Bottom Left) -->
    <div class="pt-4">
        <a href="{{ route('pegawai.pendaftaran.index') }}" 
           class="inline-flex items-center px-5 py-2.5 bg-gray-600 hover:bg-gray-700 text-white text-sm font-bold rounded-lg shadow-sm transition-colors">
            Kembali
        </a>
    </div>

</div>
@endsection
