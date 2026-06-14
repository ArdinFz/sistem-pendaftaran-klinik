@extends('backend.admin.layouts.app')

@section('title', 'Edit Dokter - Klinik Tadika Mesra')

@section('content')
<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-6">
    
    <div class="border-b border-gray-200 pb-4">
        <h1 class="text-xl font-bold text-gray-800">Edit Dokter</h1>
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

    <form action="{{ route('admin.dokter.update', $dokter['id']) }}" method="POST" class="max-w-xl space-y-5">
        @csrf
        @method('PUT')
        
        <!-- Nama Dokter -->
        <div>
            <label for="name" class="block text-sm font-bold text-gray-700 mb-1.5">Nama Dokter</label>
            <input type="text" name="name" id="name" value="{{ old('name', $dokter['name']) }}" required placeholder="Masukkan Nama Dokter"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white">
        </div>

        <!-- Keahlian -->
        <div>
            <label for="id_poli" class="block text-sm font-bold text-gray-700 mb-1.5">Keahlian (Poli)</label>
            <select name="id_poli" id="id_poli" required
                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white">
                <option value="">Pilih Poliklinik</option>
                @foreach ($polikliniks as $poli)
                    <option value="{{ $poli->id_poli }}" {{ old('id_poli', $dokter->id_poli) == $poli->id_poli ? 'selected' : '' }}>
                        {{ $poli->nama_poli }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Nomor Hp -->
        <div>
            <label for="no_hp" class="block text-sm font-bold text-gray-700 mb-1.5">Nomor Hp</label>
            <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $dokter['no_hp']) }}" required placeholder="Masukkan Nomor HP"
                class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white">
        </div>

        <!-- Tombol Aksi Simpan & Kembali -->
        <div class="flex items-center space-x-3 pt-4 border-t border-gray-100">
            <button type="submit" 
                class="px-6 py-2 bg-[#6366f1] hover:bg-[#4f46e5] text-white font-bold rounded-lg text-sm transition-colors shadow-sm active:scale-[0.98]">
                Simpan
            </button>
            <a href="{{ route('admin.dokter.index') }}" 
                class="px-6 py-2 bg-gray-500 hover:bg-gray-600 text-white font-bold rounded-lg text-sm transition-colors shadow-sm active:scale-[0.98]">
                Kembali
            </a>
        </div>

    </form>

</div>
@endsection
