<!-- ==================== TAB 4: AKUN ==================== -->
<div id="content-akun" class="tab-content space-y-6 hidden">
    
    <!-- Header / Top Bar for Profil Akun -->
    <div class="bg-white border-b border-gray-100 -mx-5 -mt-6 mb-6 py-3.5 px-6 flex justify-between items-center sticky top-0 z-40 shadow-sm">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Klinik" class="h-10 w-auto object-contain">
        </div>
        <!-- Title Center -->
        <h2 class="text-lg font-bold text-[#005b66] tracking-wide flex-1 text-center pr-8">Profil Akun</h2>
        <!-- Empty right to balance flex -->
        <div></div>
    </div>

    <!-- Main Profile Card Container -->
    <div class="bg-white border border-gray-400 rounded-lg p-5 shadow-sm space-y-6">
        
        <!-- Profile Header: Avatar & Info -->
        <div class="flex items-center space-x-4 pb-5 border-b border-gray-100">
            <!-- Avatar -->
            <div class="w-20 h-20 flex-shrink-0 border border-gray-200 rounded-lg p-1 bg-white overflow-hidden">
                <img src="{{ asset('assets/images/profile.png') }}" alt="Avatar Pasien" class="w-full h-full object-contain">
            </div>
            <!-- Info Details -->
            <div class="flex-1 min-w-0 space-y-0.5">
                <h2 class="text-lg font-bold text-gray-800 leading-tight">{{ $pasien->nama }}</h2>
                <p class="text-xs text-gray-500 font-medium truncate">{{ $pasien->email ?? '-' }}</p>
                <p class="text-xs text-gray-500 font-medium truncate">{{ $pasien->no_hp ?? '-' }}</p>
                <span class="hidden" id="pasien-nik">{{ $pasien->nik }}</span>
            </div>
        </div>

        <!-- Buttons List -->
        <div class="space-y-3">
            
            <!-- Data Pribadi -->
            <button onclick="alert('Fitur Data Pribadi segera hadir')" class="w-full bg-white border border-gray-300 hover:bg-gray-50 transition-colors rounded-lg px-4 py-3 flex items-center justify-between shadow-sm focus:outline-none">
                <div class="flex items-center space-x-3 text-gray-700">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span class="font-bold text-sm text-gray-800">Data Pribadi</span>
                </div>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Riwayat Kunjungan -->
            <button onclick="switchTab('riwayat')" class="w-full bg-white border border-gray-300 hover:bg-gray-50 transition-colors rounded-lg px-4 py-3 flex items-center justify-between shadow-sm focus:outline-none">
                <div class="flex items-center space-x-3 text-gray-700">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="font-bold text-sm text-gray-800">Riwayat Kunjungan</span>
                </div>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Ubah Password -->
            <button onclick="alert('Fitur Ubah Password segera hadir')" class="w-full bg-white border border-gray-300 hover:bg-gray-50 transition-colors rounded-lg px-4 py-3 flex items-center justify-between shadow-sm focus:outline-none">
                <div class="flex items-center space-x-3 text-gray-700">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    <span class="font-bold text-sm text-gray-800">Ubah Password</span>
                </div>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Bantuan -->
            <button onclick="alert('Fitur Bantuan segera hadir')" class="w-full bg-white border border-gray-300 hover:bg-gray-50 transition-colors rounded-lg px-4 py-3 flex items-center justify-between shadow-sm focus:outline-none">
                <div class="flex items-center space-x-3 text-gray-700">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0-5.656L18.364 7.05M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9 5.25h.008v.008H12v-.008z" />
                    </svg>
                    <span class="font-bold text-sm text-gray-800">Bantuan</span>
                </div>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Keluar -->
            <button onclick="document.getElementById('logout-form').submit();" class="w-full bg-white border border-gray-300 hover:bg-gray-50 transition-colors rounded-lg px-4 py-3 flex items-center justify-between shadow-sm focus:outline-none">
                <div class="flex items-center space-x-3 text-red-650">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span class="font-bold text-sm text-gray-800">Keluar</span>
                </div>
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Hidden Logout Form -->
            <form id="logout-form" action="{{ route('pasien.logout') }}" method="POST" class="hidden">
                @csrf
            </form>

        </div>
    </div>
</div>
