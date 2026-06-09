<aside class="w-64 bg-[#07333a] text-gray-300 flex flex-col justify-between">
    <nav class="py-4 space-y-1">
        <!-- Beranda (Active if dashboard) -->
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center px-6 py-3 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-[#1e293b] text-white border-l-4 border-teal-400 font-medium' : 'hover:bg-[#114048] hover:text-white' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Beranda
        </a>

        <!-- Akun (Active if users.*) -->
        <a href="{{ route('admin.users.index') }}" 
           class="flex items-center px-6 py-3 transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-[#1e293b] text-white border-l-4 border-teal-400 font-medium' : 'hover:bg-[#114048] hover:text-white' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Akun
        </a>

        <!-- Laporan (Active if laporan.*) -->
        <a href="{{ route('admin.laporan.index') }}" 
           class="flex items-center px-6 py-3 transition-colors {{ request()->routeIs('admin.laporan.*') ? 'bg-[#1e293b] text-white border-l-4 border-teal-400 font-medium' : 'hover:bg-[#114048] hover:text-white' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Laporan
        </a>

        <!-- Jadwal Dokter (Active if jadwal-dokter.*) -->
        <a href="{{ route('admin.jadwal-dokter.index') }}" 
           class="flex items-center px-6 py-3 transition-colors {{ request()->routeIs('admin.jadwal-dokter.*') ? 'bg-[#1e293b] text-white border-l-4 border-teal-400 font-medium' : 'hover:bg-[#114048] hover:text-white' }}">
            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Jadwal Dokter
        </a>

        <!-- Dropdown Data Master (Pasien, Dokter, Poliklinik) -->
        <details class="group" {{ request()->routeIs('admin.pasien.*') || request()->routeIs('admin.dokter.*') || request()->routeIs('admin.poliklinik.*') ? 'open' : '' }}>
            <summary class="flex items-center justify-between px-6 py-3 cursor-pointer hover:bg-[#114048] hover:text-white transition-colors list-none">
                <span class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                    </svg>
                    Data Master
                </span>
                <svg class="w-4 h-4 transition-transform group-open:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>
            <div class="bg-[#05262c] pl-8 py-1 space-y-1">
                <a href="{{ route('admin.pasien.index') }}" class="block px-6 py-2 text-sm transition-colors {{ request()->routeIs('admin.pasien.*') ? 'text-white font-medium bg-[#114048] rounded-l-lg' : 'hover:text-white' }}">Pasien</a>
                <a href="{{ route('admin.dokter.index') }}" class="block px-6 py-2 text-sm transition-colors {{ request()->routeIs('admin.dokter.*') ? 'text-white font-medium bg-[#114048] rounded-l-lg' : 'hover:text-white' }}">Dokter</a>
                <a href="{{ route('admin.poliklinik.index') }}" class="block px-6 py-2 text-sm transition-colors {{ request()->routeIs('admin.poliklinik.*') ? 'text-white font-medium bg-[#114048] rounded-l-lg' : 'hover:text-white' }}">Poliklinik</a>
            </div>
        </details>
    </nav>
</aside>