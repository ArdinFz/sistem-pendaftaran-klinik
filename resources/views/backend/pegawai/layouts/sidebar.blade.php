<aside class="w-64 bg-[#07333a] text-gray-300 flex flex-col justify-between">
    <nav class="py-4 space-y-1">
        <!-- Beranda (Active if pegawai.dashboard) -->
        <a href="{{ route('pegawai.dashboard') }}" 
           class="flex items-center px-6 py-3 transition-colors {{ request()->routeIs('pegawai.dashboard') ? 'bg-[#1e293b] text-white border-l-4 border-teal-400 font-medium' : 'hover:bg-[#114048] hover:text-white' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Beranda
        </a>

        <!-- Data Pendaftaran (Active if pegawai.pendaftaran.*) -->
        <a href="{{ route('pegawai.pendaftaran.index') }}" 
           class="flex items-center px-6 py-3 transition-colors {{ request()->routeIs('pegawai.pendaftaran.*') ? 'bg-[#1e293b] text-white border-l-4 border-teal-400 font-medium' : 'hover:bg-[#114048] hover:text-white' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Data Pendaftaran
        </a>
    </nav>
</aside>
