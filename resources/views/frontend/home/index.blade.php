<!-- ==================== TAB 1: BERANDA ==================== -->
<div id="content-beranda" class="tab-content space-y-6">
    
    <!-- Greeting Card (Halo, Pasien!) -->
    <div class="bg-[#005b66] text-white rounded-md p-5 shadow-md border border-teal-700 relative flex justify-between items-start">
        <div class="space-y-1 pr-6">
            <h2 class="text-lg font-bold tracking-wide">Halo, {{ $pasien->nama }}!</h2>
            <p class="text-xs text-teal-100 leading-relaxed font-medium">Jadi ceritanya ini tampilan kalo dah login, yaudah sih gitu ajah</p>
        </div>
        <!-- Notification Bell -->
        <button class="text-white hover:text-teal-250 p-1 focus:outline-none cursor-default">
            <!-- Bell Icon SVG -->
            <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
        </button>
    </div>

    <!-- Top Cards: Antrean Online & Cek Antrean -->
    <div class="grid grid-cols-2 gap-4">
        
        <!-- Antrean Online Card (Solid Teal, rounded-md) -->
        <div class="bg-[#005b66] text-white rounded-md p-4 flex flex-col justify-between shadow-md border border-teal-700 min-h-[155px]">
            <div class="space-y-1.5">
                <div class="flex items-center space-x-1.5">
                    <!-- Calendar Icon (White) -->
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span class="font-bold text-sm tracking-wide border-b border-teal-50 pb-0.5">Antrean Online</span>
                </div>
                <p class="text-[11px] text-teal-100 leading-relaxed">Ambil antrean tanpa perlu datang langsung ke klinik</p>
            </div>
            <!-- Switches to Daftar Antrean Form Tab -->
            <button onclick="switchTab('daftar-antrean')" class="w-full text-center bg-white text-[#005b66] hover:bg-teal-50 transition-colors font-bold py-2 rounded-md text-xs shadow-sm mt-3">
                Daftar Antrean
            </button>
        </div>

        <!-- Cek Antrean Card (White with Border, rounded-md) -->
        <div class="bg-white text-gray-800 rounded-md p-4 flex flex-col justify-between shadow-sm border border-gray-200 min-h-[155px]">
            <div class="space-y-1.5">
                <div class="flex items-center space-x-1.5">
                    <!-- Clock/History Icon -->
                    <svg class="w-7 h-7 text-[#005b66]" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-bold text-[#005b66] text-sm tracking-wide border-b border-teal-50 pb-0.5">Cek Antrean</span>
                </div>
                <p class="text-[11px] text-gray-500 leading-relaxed">Pantau nomor antrean secara langsung</p>
            </div>
            <!-- Switches to Antrean Tab -->
            <button onclick="switchTab('antrean')" class="w-full bg-[#005b66] text-white hover:bg-[#004a54] transition-colors font-bold py-2 rounded-md text-xs shadow-sm mt-3">
                Cek Antrean
            </button>
        </div>

    </div>

    <!-- Services Grid: 6 Items -->
    <div class="grid grid-cols-3 md:grid-cols-6 gap-3">
        
        <!-- Layanan Klinik -->
        <a href="{{ route('pasien.layanan') }}" class="bg-white border border-teal-600 rounded-md p-2.5 flex flex-col items-center justify-center space-y-1.5 shadow-sm hover:scale-[1.02] active:scale-[0.98] transition-all">
            <div class="w-[72px] h-[72px] flex items-center justify-center overflow-hidden">
                <img src="{{ asset('assets/images/layanan.png') }}" alt="Layanan Klinik" class="w-full h-full object-contain">
            </div>
            <span class="text-[10px] font-bold text-[#005b66] text-center leading-tight">Layanan Klinik</span>
        </a>

        <!-- Jadwal Dokter -->
        <a href="{{ route('pasien.jadwal') }}" class="bg-white border border-teal-600 rounded-md p-2.5 flex flex-col items-center justify-center space-y-1.5 shadow-sm hover:scale-[1.02] active:scale-[0.98] transition-all">
            <div class="w-[72px] h-[72px] flex items-center justify-center overflow-hidden">
                <img src="{{ asset('assets/images/jadwal.png') }}" alt="Jadwal Dokter" class="w-full h-full object-contain">
            </div>
            <span class="text-[10px] font-bold text-[#005b66] text-center leading-tight">Jadwal Dokter</span>
        </a>

        <!-- Cara Daftar -->
        <a href="{{ route('pasien.cara-daftar') }}" class="bg-white border border-teal-600 rounded-md p-2.5 flex flex-col items-center justify-center space-y-1.5 shadow-sm hover:scale-[1.02] active:scale-[0.98] transition-all">
            <div class="w-[72px] h-[72px] flex items-center justify-center overflow-hidden">
                <img src="{{ asset('assets/images/cara_daftar.png') }}" alt="Cara Daftar" class="w-full h-full object-contain">
            </div>
            <span class="text-[10px] font-bold text-[#005b66] text-center leading-tight">Cara Daftar</span>
        </a>

        <!-- Tentang Klinik -->
        <a href="{{ route('pasien.tentang-klinik') }}" class="bg-white border border-teal-600 rounded-md p-2.5 flex flex-col items-center justify-center space-y-1.5 shadow-sm hover:scale-[1.02] active:scale-[0.98] transition-all">
            <div class="w-[72px] h-[72px] flex items-center justify-center overflow-hidden">
                <img src="{{ asset('assets/images/tentang_klinik.png') }}" alt="Tentang Klinik" class="w-full h-full object-contain">
            </div>
            <span class="text-[10px] font-bold text-[#005b66] text-center leading-tight">Tentang Klinik</span>
        </a>

        <!-- Tips Kesehatan -->
        <a href="{{ route('pasien.tips-kesehatan') }}" class="bg-white border border-teal-600 rounded-md p-2.5 flex flex-col items-center justify-center space-y-1.5 shadow-sm hover:scale-[1.02] active:scale-[0.98] transition-all">
            <div class="w-[72px] h-[72px] flex items-center justify-center overflow-hidden">
                <img src="{{ asset('assets/images/tips_kesehatan.png') }}" alt="Tips Kesehatan" class="w-full h-full object-contain">
            </div>
            <span class="text-[10px] font-bold text-[#005b66] text-center leading-tight">Tips Kesehatan</span>
        </a>

        <!-- SOS (Statis) -->
        <div class="bg-white border border-red-500 rounded-md p-2.5 flex flex-col items-center justify-center space-y-1.5 shadow-sm">
            <div class="w-12 h-12 flex items-center justify-center bg-red-600 rounded-full shadow-inner">
                <span class="text-white font-extrabold text-sm">SOS</span>
            </div>
            <span class="text-[10px] font-bold text-red-600 text-center leading-tight">Bantuan Darurat</span>
        </div>

    </div>

    <!-- Pengumuman Section -->
    <div class="space-y-3 pb-6">
        <h3 class="text-base font-extrabold text-[#005b66] tracking-wide border-l-4 border-[#005b66] pl-2">| Pengumuman</h3>
        
        <div class="w-full">
            <img src="{{ asset('assets/images/pengumuman.png') }}" alt="Pengumuman Libur" class="w-full h-auto rounded-md shadow-sm border border-gray-250">
        </div>
    </div>

</div>
