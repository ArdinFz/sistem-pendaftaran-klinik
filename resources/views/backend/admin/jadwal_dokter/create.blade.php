@extends('backend.admin.layouts.app')

@section('title', 'Tambah Jadwal Dokter - Klinik Tadika Mesra')

@section('content')
<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-6">
    
    <div class="border-b border-gray-200 pb-4">
        <h1 class="text-xl font-bold text-gray-800">Tambah Jadwal Dokter</h1>
    </div>

    <!-- Alert validasi error -->
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg text-sm" role="alert">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.jadwal-dokter.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <!-- Form Fields Grid (2 Columns) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            <!-- Sisi Kiri -->
            <div class="space-y-5">
                <!-- Dokter -->
                <div>
                    <label for="dokter" class="block text-sm font-bold text-gray-700 mb-1.5">Dokter</label>
                    <select name="dokter" id="dokter" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white">
                        <option value="">-- Pilih Dokter --</option>
                        @foreach($dokters as $d)
                            <option value="{{ $d }}" {{ old('dokter') == $d ? 'selected' : '' }}>{{ $d }}</option>
                        @endforeach
                    </select>
                </div>



                <!-- Kuota -->
                <div>
                    <label for="kuota" class="block text-sm font-bold text-gray-700 mb-1.5">Kuota</label>
                    <input type="number" name="kuota" id="kuota" value="{{ old('kuota') }}" required min="1" placeholder="Kuota pendaftaran"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white">
                </div>
            </div>

            <!-- Sisi Kanan -->
            <div class="space-y-5">
                <!-- Hari -->
                <div>
                    <label for="hari" class="block text-sm font-bold text-gray-700 mb-1.5">Hari</label>
                    <select name="hari" id="hari" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white">
                        <option value="">-- Pilih Hari --</option>
                        @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $h)
                            <option value="{{ $h }}" {{ old('hari') == $h ? 'selected' : '' }}>{{ $h }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Jam Mulai -->
                <div>
                    <label for="jam_mulai" class="block text-sm font-bold text-gray-700 mb-1.5">Jam Mulai</label>
                    <input type="text" name="jam_mulai" id="jam_mulai" value="{{ old('jam_mulai') }}" required placeholder="Contoh: 08:00"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white">
                </div>

                <!-- Jam Selesai -->
                <div>
                    <label for="jam_selesai" class="block text-sm font-bold text-gray-700 mb-1.5">Jam Selesai</label>
                    <input type="text" name="jam_selesai" id="jam_selesai" value="{{ old('jam_selesai') }}" required placeholder="Contoh: 10:00"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white">
                </div>
            </div>

        </div>

        <!-- Tombol Aksi Simpan & Kembali -->
        <div class="flex items-center space-x-3 pt-4 border-t border-gray-100">
            <button type="submit" 
                class="px-6 py-2 bg-[#6366f1] hover:bg-[#4f46e5] text-white font-bold rounded-lg text-sm transition-colors shadow-sm active:scale-[0.98]">
                Simpan
            </button>
            <a href="{{ route('admin.jadwal-dokter.index') }}" 
                class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white font-bold rounded-lg text-sm transition-colors shadow-sm active:scale-[0.98]">
                Kembali
            </a>
        </div>

    </form>

</div>
@endsection
