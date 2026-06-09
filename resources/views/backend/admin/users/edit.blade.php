@extends('backend.admin.layouts.app')

@section('title', 'Edit Akun - Klinik Tadika Mesra')

@section('content')
<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-6">
    
    <div class="border-b border-gray-200 pb-4">
        <h1 class="text-2xl font-bold text-gray-800">Edit Akun</h1>
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

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @csrf
        @method('PUT')
        
        <!-- Sisi Kiri: Unggah Foto (1 Bagian) -->
        <div class="flex flex-col items-center space-y-4">
            <span class="block text-lg font-bold text-gray-700 w-full text-left">Foto</span>
            
            <!-- Tempat Uploader / Preview Box -->
            <label for="foto" class="w-full aspect-square border-2 border-dashed border-gray-300 hover:border-[#005b66] rounded-xl flex flex-col items-center justify-center text-gray-500 bg-gray-50 hover:bg-gray-100 cursor-pointer overflow-hidden relative transition-colors">
                <!-- Preview Image -->
                @if($user->foto)
                    <img id="preview" src="{{ asset($user->foto) }}" alt="Preview Foto" class="w-full h-full object-cover">
                @else
                    <img id="preview" src="#" alt="Preview Foto" class="hidden w-full h-full object-cover">
                @endif
                
                <!-- Placeholder Teks & Icon (Tersembunyi jika foto sudah ada) -->
                <div id="placeholder" class="flex flex-col items-center justify-center space-y-2 p-4 text-center {{ $user->foto ? 'hidden' : '' }}">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.827 6.175A2.31 2.31 0 015.186 7.23c-.38.054-.757.112-1.134.175C2.999 7.58 2.25 8.507 2.25 9.574V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9.574c0-1.067-.75-1.994-1.802-2.169a47.865 47.865 0 00-1.134-.175 2.31 2.31 0 01-1.64-1.055l-.822-1.316a2.192 2.192 0 00-1.736-1.039 48.774 48.774 0 00-5.232 0 2.192 2.192 0 00-1.736 1.039l-.821 1.316z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12.75a4.5 4.5 0 11-9 0 4.5 4.5 0 019 0zM18.75 10.5h.008v.008h-.008V10.5z" />
                    </svg>
                    <span class="text-sm font-semibold">Pilih Foto Baru</span>
                    <span class="text-xs text-gray-400">Format: JPG, PNG, JPEG (Maks. 2MB)</span>
                </div>
            </label>
            <!-- Input File Asli (Hidden) -->
            <input type="file" name="foto" id="foto" accept="image/*" class="hidden" onchange="previewImage(event)">
        </div>

        <!-- Sisi Kanan: Input Form Kolom Kanan (2 Bagian) -->
        <div class="md:col-span-2 space-y-5">
            <!-- Hak Akses (Dropdown) -->
            <div>
                <label for="role" class="block text-sm font-bold text-gray-700 mb-1.5">Hak Akses</label>
                <select name="role" id="role" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white">
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="pegawai" {{ old('role', $user->role) == 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                </select>
            </div>

            <!-- Status (Dropdown) -->
            <div>
                <label for="status" class="block text-sm font-bold text-gray-700 mb-1.5">Status</label>
                <select name="status" id="status" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white">
                    <option value="aktif" {{ old('status', $user->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status', $user->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <!-- NIK -->
            <div>
                <label for="nik" class="block text-sm font-bold text-gray-700 mb-1.5">NIK</label>
                <input type="text" name="nik" id="nik" value="{{ old('nik', $user->nik) }}" required placeholder="Masukkan NIK"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-bold text-gray-700 mb-1.5">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required placeholder="Masukkan Email"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white">
            </div>

            <!-- Nama -->
            <div>
                <label for="name" class="block text-sm font-bold text-gray-700 mb-1.5">Nama</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required placeholder="Masukkan Nama"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white">
            </div>

            <!-- Jenis Kelamin (Dropdown) -->
            <div>
                <label for="jenis_kelamin" class="block text-sm font-bold text-gray-700 mb-1.5">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white">
                    <option value="L" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin', $user->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <!-- Tanggal Lahir -->
            <div>
                <label for="tanggal_lahir" class="block text-sm font-bold text-gray-700 mb-1.5">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $user->tanggal_lahir) }}" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white">
            </div>

            <!-- HP -->
            <div>
                <label for="no_hp" class="block text-sm font-bold text-gray-700 mb-1.5">HP</label>
                <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $user->no_hp) }}" required placeholder="Masukkan Nomor HP"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white">
            </div>

            <!-- Tombol Aksi Simpan & Kembali -->
            <div class="flex items-center space-x-3 pt-4 border-t border-gray-100">
                <button type="submit" 
                    class="px-6 py-2.5 bg-[#6366f1] hover:bg-[#4f46e5] text-white font-bold rounded-lg text-sm transition-colors shadow-sm active:scale-[0.98]">
                    Simpan
                </button>
                <a href="{{ route('admin.users.index') }}" 
                    class="px-6 py-2.5 bg-gray-500 hover:bg-gray-600 text-white font-bold rounded-lg text-sm transition-colors shadow-sm">
                    Kembali
                </a>
            </div>
        </div>
    </form>

</div>

<!-- Script Javascript untuk Live Preview Gambar Uploader -->
@push('scripts')
<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('preview');
            var placeholder = document.getElementById('placeholder');
            output.src = reader.result;
            output.classList.remove('hidden');
            if (placeholder) {
                placeholder.classList.add('hidden');
            }
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endpush
@endsection
