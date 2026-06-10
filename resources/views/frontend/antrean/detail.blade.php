<!-- ==================== TAB 2.7: DETAIL ANTREAN (Mockup Kanan) ==================== -->
<div id="content-detail-antrean" class="tab-content space-y-6 hidden">
    <!-- Header / Top Bar for Detail Antrean -->
    <div class="bg-[#005b66] text-white -mx-5 -mt-6 mb-6 py-4 px-5 flex items-center space-x-4 shadow-md">
        <button onclick="switchTab('antrean')" class="text-white hover:text-teal-200 transition-colors focus:outline-none">
            <!-- Back arrow icon SVG -->
            <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </button>
        <h2 class="text-lg font-bold tracking-wide flex-1 text-center pr-8">Detail Antrean</h2>
    </div>

    @if($myLatestAntrean)
        <!-- Card detail antrean -->
        <div class="bg-white border border-teal-600 rounded-lg p-5 shadow-sm space-y-4">
            <div class="flex justify-between items-start">
                <div>
                    <span class="text-xs font-bold text-gray-800 block">Nomor Antrean</span>
                    <span class="text-5xl font-extrabold text-[#005b66] block mt-1">
                        {{ sprintf("%03d", $myLatestAntrean->nomor_antrean) }}
                    </span>
                </div>
                <div class="mt-2">
                    @if($myLatestAntrean->status_antrean === 'Selesai')
                        <span class="bg-[#005b66] text-white px-2.5 py-1 rounded text-[10px] font-bold flex items-center space-x-1">
                            <svg class="w-3.5 h-3.5 mr-1 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                            </svg>
                            Selesai
                        </span>
                    @elseif($myLatestAntrean->status_antrean === 'Dipanggil')
                        <span class="bg-[#005b66] text-white px-2.5 py-1 rounded text-[10px] font-bold flex items-center space-x-1 animate-pulse">
                            <svg class="w-3.5 h-3.5 mr-1 text-white animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364-6.364l-.707.707M6.343 17.657l-.707.707m0-12.728l.707.707m11.314 11.314l.707-.707" />
                            </svg>
                            Sedang Dipanggil
                        </span>
                    @else
                        <span class="bg-gray-400 text-white px-2.5 py-1 rounded text-[10px] font-bold flex items-center space-x-1">
                            <svg class="w-3.5 h-3.5 mr-1 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Menunggu
                        </span>
                    @endif
                </div>
            </div>

            <div class="border-t border-gray-150 pt-4 space-y-2.5 text-xs text-gray-700">
                <div class="flex justify-between">
                    <span class="text-gray-400 font-semibold">Nama</span>
                    <span class="text-gray-800 font-bold text-right max-w-[250px] truncate">{{ $myLatestAntrean->pendaftaran->pasien }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400 font-semibold">Poli</span>
                    <span class="text-gray-800 font-bold text-right">{{ $myLatestAntrean->poli }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400 font-semibold">Tanggal</span>
                    <span class="text-gray-800 font-bold text-right">
                        {{ $myLatestAntrean->pendaftaran->tanggal_daftar ? $myLatestAntrean->pendaftaran->tanggal_daftar->format('d F Y') : '-' }}
                    </span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400 font-semibold">Dokter</span>
                    <span class="text-gray-800 font-bold text-right">{{ $myLatestAntrean->dokter }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400 font-semibold">Jam</span>
                    <span class="text-gray-800 font-bold text-right">{{ $myLatestAntrean->pendaftaran->jam }}</span>
                </div>
                <div class="flex justify-between items-start pt-1">
                    <span class="text-gray-400 font-semibold">Keluhan</span>
                    <span class="text-gray-800 font-bold text-right max-w-[240px] italic">“{{ $myLatestAntrean->pendaftaran->keluhan }}”</span>
                </div>
            </div>
        </div>

        <!-- Estimasi Waktu Box -->
        <div class="bg-[#005b66] text-white rounded-md p-5 shadow-sm flex justify-between items-center">
            <div class="space-y-1">
                <span class="text-xs text-teal-100 font-semibold block">Estimasi Waktu</span>
                <span class="text-xl font-bold block">{{ $estimatedWaitTime }}</span>
            </div>
            <div class="w-10 h-10 flex items-center justify-center bg-white/10 rounded-full">
                <!-- Clock SVG (White) -->
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>

        <!-- Illustration (doctor and patient) -->
        <div class="flex justify-center py-2">
            <img src="{{ asset('assets/images/doctor_patient.png') }}" alt="Ilustrasi Detail Antrean" class="w-48 h-auto object-contain">
        </div>

        <!-- Footer Warning Note -->
        <div class="flex items-center justify-center space-x-1.5 text-[11px] font-semibold text-gray-500 italic pb-6">
            <span>Harap tunggu hingga nomor antrean Anda dipanggil</span>
        </div>
    @endif
</div>
