<!-- ==================== TAB 2: ANTREAN ==================== -->
<div id="content-antrean" class="tab-content space-y-6 hidden">
    <!-- Header Logo -->
    <div class="flex justify-center items-center py-2.5">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-12 w-auto object-contain">
    </div>
    <hr class="border-gray-100 -mx-5 mb-4">

    <!-- Antrean Sedang Berjalan (Mockup Kiri) -->
    <div class="bg-[#005b66] text-white rounded-md p-5 shadow-md border border-teal-700 space-y-4">
        <h2 class="text-base font-bold tracking-wide">Antrean Sedang Berjalan</h2>
        
        <div class="space-y-3">
            @forelse($calledAntreans as $item)
                <div class="bg-white rounded-md p-4 text-gray-800 shadow-sm border border-teal-100">
                    <h3 class="text-sm font-bold text-[#005b66] pb-1.5 border-b border-gray-100">{{ $item->poli }}</h3>
                    <div class="pt-2 text-center">
                        <span class="text-[10px] text-gray-450 font-semibold block">Nomor yang sedang dipanggil</span>
                        <span class="text-4xl font-extrabold text-[#005b66] tracking-wide block mt-1">
                            {{ sprintf("%03d", $item->nomor_antrean) }}
                        </span>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-md p-4 text-center border border-teal-100">
                    <span class="text-xs text-gray-400 font-semibold italic">Belum ada antrean yang sedang dipanggil</span>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Daftar Antrean Hari Ini (Mockup Kiri) -->
    <div class="space-y-3">
        <h3 class="text-base font-bold text-gray-800 tracking-wide">Daftar Antrean Hari Ini</h3>
        
        <div class="bg-white border border-teal-600 rounded-md shadow-sm divide-y divide-gray-150">
            @forelse($allAntreans as $item)
                <div class="flex justify-between items-center p-3.5">
                    <span class="text-base font-bold text-[#005b66]">{{ sprintf("%03d", $item->nomor_antrean) }}</span>
                    
                    @if($item->status_antrean === 'Selesai')
                        <span class="bg-[#005b66] text-white px-3 py-1 rounded text-[10px] font-bold flex items-center space-x-1">
                            <svg class="w-3.5 h-3.5 mr-1 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Selesai
                        </span>
                    @elseif($item->status_antrean === 'Dipanggil')
                        <span class="bg-[#005b66] text-white px-3 py-1 rounded text-[10px] font-bold flex items-center space-x-1 animate-pulse">
                            <svg class="w-3.5 h-3.5 mr-1 text-white animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m11.314 11.314l.707-.707" />
                            </svg>
                            Sedang Dipanggil
                        </span>
                    @else
                        <span class="bg-gray-400 text-white px-3 py-1 rounded text-[10px] font-bold flex items-center space-x-1">
                            <svg class="w-3.5 h-3.5 mr-1 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Menunggu
                        </span>
                    @endif
                </div>
            @empty
                <div class="p-6 text-center text-xs text-gray-400 font-semibold italic border-t border-gray-150">
                    Tidak ada antrean hari ini
                </div>
            @endforelse
        </div>
    </div>

    <!-- Tombol Lihat Antrean Saya -->
    <div class="pt-2">
        @if($myLatestAntrean)
            <button onclick="switchTab('detail-antrean')" class="w-full bg-[#005b66] hover:bg-[#004a54] text-white font-bold py-3.5 rounded-md text-sm transition-all shadow hover:shadow-md active:scale-[0.99]">
                Lihat Antrean Saya
            </button>
        @else
            <button onclick="alert('Anda belum memiliki pendaftaran antrean aktif saat ini.')" class="w-full bg-gray-300 text-gray-500 font-bold py-3.5 rounded-md text-sm cursor-not-allowed" disabled>
                Lihat Antrean Saya
            </button>
        @endif
    </div>
</div>
