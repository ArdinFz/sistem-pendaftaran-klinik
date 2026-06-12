<!-- ==================== TAB 3: RIWAYAT ==================== -->
<div id="content-riwayat" class="tab-content space-y-6 hidden">
    <!-- Header Logo -->
    <div class="flex items-center space-x-3 py-2.5">
        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-10 w-auto object-contain">
        <span class="text-lg font-bold text-gray-800">Riwayat Kunjungan</span>
    </div>
    <hr class="border-gray-150 -mx-5 mb-4">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4" id="riwayat-list-container">
        @php
            $months = [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            ];
        @endphp

        @forelse ($completedPendaftarans as $p)
            <div class="bg-white border border-teal-600 rounded-lg p-5 shadow-sm space-y-3">
                <!-- Date & Time Row -->
                <div class="text-xs text-gray-400 font-semibold">
                    @if($p->tanggal_daftar)
                        {{ $p->tanggal_daftar->format('d') }} {{ $months[(int)$p->tanggal_daftar->format('m')] ?? 'Januari' }} {{ $p->tanggal_daftar->format('Y') }}
                    @else
                        -
                    @endif
                    | {{ $p->jadwalDokter ? date('H:i', strtotime($p->jadwalDokter->jam_mulai)) : '08:00' }} WIB
                </div>

                <!-- Poli & Doctor Name & Queue Number Row -->
                <div class="flex justify-between items-start">
                    <div class="space-y-1">
                        <h2 class="text-xl font-bold text-gray-800 leading-tight">{{ $p->poli }}</h2>
                        <p class="text-xs font-semibold text-gray-500">{{ $p->dokter }}</p>
                    </div>
                    <div class="text-3xl font-extrabold text-[#005b66]">
                        {{ sprintf("%03d", $p->nomor_antrean) }}
                    </div>
                </div>

                <!-- Divider -->
                <hr class="border-gray-150">

                <!-- Complaint -->
                <p class="text-xs text-gray-600 leading-relaxed italic">
                    “{{ $p->keluhan }}”
                </p>
            </div>
        @empty
            <div class="col-span-full text-center py-16 bg-white rounded-lg border border-gray-150 p-6 shadow-sm">
                <p class="text-xs text-gray-450 font-semibold italic">Belum ada riwayat kunjungan yang selesai.</p>
            </div>
        @endforelse
    </div>
</div>
