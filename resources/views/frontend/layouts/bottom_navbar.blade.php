<nav class="fixed bottom-0 left-0 right-0 bg-[#005b66] text-teal-100 flex h-16 shadow-lg z-30 border-t border-[#004d57]">
    
    <!-- Tab Beranda Button -->
    <button id="nav-btn-beranda" onclick="switchTab('beranda')" class="flex-1 h-full flex flex-col items-center justify-center space-y-0.5 text-white bg-[#1a2c35] border-r border-[#004d57] nav-btn">
        <!-- Home Icon -->
        <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2.2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        <span class="text-[10px] font-bold">Beranda</span>
    </button>

    <!-- Tab Antrean Button -->
    <button id="nav-btn-antrean" onclick="switchTab('antrean')" class="flex-1 h-full flex flex-col items-center justify-center space-y-0.5 hover:text-white transition-colors bg-[#005b66] border-r border-[#004d57] nav-btn">
        <!-- Calendar Icon -->
        <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
        </svg>
        <span class="text-[10px] font-semibold">Antrean</span>
    </button>

    <!-- Tab Riwayat Button -->
    <button id="nav-btn-riwayat" onclick="switchTab('riwayat')" class="flex-1 h-full flex flex-col items-center justify-center space-y-0.5 hover:text-white transition-colors bg-[#005b66] border-r border-[#004d57] nav-btn">
        <!-- Clock/History Icon -->
        <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="text-[10px] font-semibold">Riwayat</span>
    </button>

    <!-- Tab Akun Button -->
    <button id="nav-btn-akun" onclick="switchTab('akun')" class="flex-1 h-full flex flex-col items-center justify-center space-y-0.5 hover:text-white transition-colors bg-[#005b66] nav-btn">
        <!-- User Icon -->
        <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg>
        <span class="text-[10px] font-semibold">Akun</span>
    </button>

</nav>
