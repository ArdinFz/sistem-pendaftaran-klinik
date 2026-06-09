@extends('backend.admin.layouts.app')

@section('title', 'Data Akun - Klinik Tadika Mesra')

@section('content')
<div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6 space-y-6">
    
    <!-- Bagian Alert Notifikasi -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-r-lg text-sm mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg text-sm mb-4" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <!-- Header Tabel & Search Bar -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <!-- Tombol Tambah (Hijau) -->
        <div>
            <a href="{{ route('admin.users.create') }}" 
                class="inline-flex items-center px-4 py-2 bg-[#10b981] hover:bg-[#059669] text-white font-bold rounded-lg text-sm transition-colors shadow-sm">
                <!-- Icon Plus -->
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                + Tambah
            </a>
        </div>

        <!-- Form Pencarian (Search) -->
        <div class="w-full md:w-auto">
            <form action="{{ route('admin.users.index') }}" method="GET" class="flex items-center space-x-2">
                <label for="search" class="text-sm font-semibold text-gray-700">Search:</label>
                <input type="text" name="search" id="search" value="{{ $search }}"
                    class="w-full md:w-64 px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-[#005b66] bg-white">
                @if($search)
                    <a href="{{ route('admin.users.index') }}" class="text-xs text-red-500 hover:underline">Clear</a>
                @endif
            </form>
        </div>
    </div>

    <!-- Container Tabel Data Akun -->
    <div class="border border-gray-200 rounded-lg p-5 bg-white">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Data Akun</h2>

        <div class="space-y-2">
            <!-- Table Headers -->
            <div class="grid grid-cols-6 gap-2 text-center text-gray-700 font-bold text-sm">
                <div class="bg-white border border-gray-200 rounded-lg p-3">ID</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 text-left">Nama</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3 text-left">Email</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3">Role</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3">Status</div>
                <div class="bg-white border border-gray-200 rounded-lg p-3">Aksi</div>
            </div>

            <!-- Data Rows -->
            @forelse ($users as $user)
                @php
                    $prefix = 'USR';
                    if ($user->role === 'admin') $prefix = 'ADM';
                    elseif ($user->role === 'pegawai') $prefix = 'PGW';
                    elseif ($user->role === 'pasien') $prefix = 'PSN';
                    $formattedId = $prefix . str_pad($user->id, 3, '0', STR_PAD_LEFT);
                @endphp
                <div class="grid grid-cols-6 gap-2 text-center items-center text-gray-600 text-sm">
                    <!-- ID -->
                    <div class="bg-white border border-gray-200 rounded-lg p-3 font-semibold">{{ $formattedId }}</div>
                    
                    <!-- Nama -->
                    <div class="bg-white border border-gray-200 rounded-lg p-3 text-left font-medium flex items-center space-x-2">
                        @if($user->foto)
                            <img src="{{ asset($user->foto) }}" alt="Avatar" class="w-8 h-8 rounded-full object-cover">
                        @else
                            <img src="{{ asset('assets/images/profile.png') }}" alt="Avatar Default" class="w-8 h-8 rounded-full object-cover opacity-60">
                        @endif
                        <span>{{ $user->name }}</span>
                    </div>
                    
                    <!-- Email -->
                    <div class="bg-white border border-gray-200 rounded-lg p-3 text-left truncate">{{ $user->email }}</div>
                    
                    <!-- Role Badge -->
                    <div class="bg-white border border-gray-200 rounded-lg p-2.5 flex items-center justify-center">
                        @if ($user->role === 'admin')
                            <span class="inline-flex items-center px-3 py-1 rounded bg-[#ef4444] text-white text-xs font-semibold">
                                Admin
                            </span>
                        @elseif ($user->role === 'pegawai')
                            <span class="inline-flex items-center px-3 py-1 rounded bg-[#3b82f6] text-white text-xs font-semibold">
                                Pegawai
                            </span>
                        @elseif ($user->role === 'pasien')
                            <span class="inline-flex items-center px-3 py-1 rounded bg-[#f59e0b] text-white text-xs font-semibold">
                                Pasien
                            </span>
                        @endif
                    </div>
                    
                    <!-- Status Badge -->
                    <div class="bg-white border border-gray-200 rounded-lg p-2.5 flex items-center justify-center">
                        @if ($user->status === 'aktif')
                            <span class="inline-flex items-center justify-center w-6 h-6 rounded bg-[#10b981] text-white">
                                <!-- Check Icon -->
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                </svg>
                            </span>
                        @else
                            <span class="inline-flex items-center justify-center w-6 h-6 rounded bg-[#ef4444] text-white">
                                <!-- Cross Icon -->
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </span>
                        @endif
                    </div>
                    
                    <!-- Aksi Buttons (Edit & Hapus) -->
                    <div class="bg-white border border-gray-200 rounded-lg p-2 flex items-center justify-center space-x-2">
                        <!-- Edit Button (Biru) -->
                        <a href="{{ route('admin.users.edit', $user->id) }}" 
                            class="inline-flex items-center px-3 py-1 bg-[#2563eb] hover:bg-[#1d4ed8] text-white text-xs font-bold rounded shadow-sm transition-colors">
                            Edit
                        </a>

                        <!-- Hapus Button (Merah) -->
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="inline-flex items-center px-3 py-1 bg-[#dc2626] hover:bg-[#b91c1c] text-white text-xs font-bold rounded shadow-sm transition-colors">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="text-center py-6 text-gray-500">
                    Tidak ada data akun yang ditemukan.
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="flex justify-end mt-4">
            {{ $users->links() }}
        </div>

    </div>

</div>
@endsection