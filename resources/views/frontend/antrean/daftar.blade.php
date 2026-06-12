<!-- ==================== TAB 2.5: DAFTAR ANTREAN FORM ==================== -->
<div id="content-daftar-antrean" class="tab-content space-y-6 hidden">
    <!-- Form Header & Content -->
    <div id="antrean-form-wrapper" class="space-y-6">
        <h3 class="text-base font-extrabold text-[#005b66] tracking-wide border-l-4 border-[#005b66] pl-2">Pendaftaran Antrean</h3>
        
        <div class="bg-white border border-teal-600 rounded-lg p-5 shadow-sm">
            <form id="real-antrean-form" onsubmit="submitRealPendaftaran(event)" class="space-y-4">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Sisi Kiri: Pilihan Poli, Tanggal, Dokter -->
                    <div class="space-y-4">
                        <!-- Pilih Poli -->
                        <div>
                            <label for="select-poli" class="block text-xs font-semibold text-[#005b66] mb-1">Pilih Poli</label>
                            <select id="select-poli" required onchange="loadDoctorSchedules()" class="w-full px-3 py-2 border border-teal-600 rounded-md text-xs font-semibold text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-teal-500">
                                <option value="">Pilih Poli Tujuan</option>
                                @foreach ($polikliniks as $poli)
                                    <option value="{{ $poli->id_poli }}">{{ $poli->nama_poli }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Pilih Tanggal Daftar -->
                        <div>
                            <label for="select-date" class="block text-xs font-semibold text-[#005b66] mb-1">Pilih Tanggal Daftar</label>
                            <input type="date" required id="select-date" onchange="loadDoctorSchedules()" class="w-full px-3 py-2 border border-teal-600 rounded-md text-xs font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-500">
                        </div>

                        <!-- Pilih Dokter (Jadwal) -->
                        <div>
                            <label for="select-dokter" class="block text-xs font-semibold text-[#005b66] mb-1">Pilih Dokter</label>
                            <select id="select-dokter" name="id_jadwal" required class="w-full px-3 py-2 border border-teal-600 rounded-md text-xs font-semibold text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-teal-500">
                                <option value="">Pilih Jadwal Dokter</option>
                            </select>
                            <p id="schedule-info-text" class="text-[10px] text-gray-400 mt-1 italic hidden"></p>
                        </div>
                    </div>

                    <!-- Sisi Kanan: Keluhan -->
                    <div class="flex flex-col">
                        <label for="keluhan" class="block text-xs font-semibold text-[#005b66] mb-1">Keluhan</label>
                        <textarea id="keluhan" name="keluhan" placeholder="Isi Keluhan Anda" required class="w-full flex-1 px-3 py-2 border border-teal-600 rounded-md text-xs font-semibold text-gray-700 focus:outline-none focus:ring-2 focus:ring-teal-500 min-h-[120px] md:min-h-0"></textarea>
                    </div>
                </div>

                <!-- Tombol Simpan -->
                <button type="submit" class="w-full bg-[#005b66] hover:bg-[#004a54] text-white font-bold py-2.5 rounded-md text-sm transition-all shadow hover:shadow-md active:scale-[0.99]">
                    Simpan
                </button>
            </form>
        </div>
    </div>

    <!-- ==================== NOTIFIKASI BERHASIL ==================== -->
    <div id="antrean-success-wrapper" class="space-y-6 hidden flex flex-col items-center">
        <!-- Centang Hijau Bulat Besar -->
        <div class="flex items-center justify-center w-24 h-24 bg-[#005b66] rounded-full shadow-md mt-4">
            <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <div class="text-center space-y-1">
            <h2 class="text-xl font-bold text-gray-800">Pendaftaran Berhasil!</h2>
            <p class="text-xs text-gray-500 font-medium">Cihuyyy ketemu dokter</p>
        </div>

        <!-- Box Tiket Antrean (NOMOR ANTREAN 505) -->
        <div class="w-full max-w-sm bg-white border border-teal-600 rounded-lg p-5 shadow-sm text-center">
            <span class="text-[10px] font-bold text-gray-500 tracking-wider block">NOMOR ANTREAN</span>
            <h1 class="text-6xl font-extrabold text-[#005b66] my-2" id="success-queue-number">505</h1>
            
            <div class="border-t border-gray-100 pt-4 mt-3 text-left space-y-2 text-xs text-gray-700 px-2">
                <div class="flex justify-between">
                    <span class="font-medium text-gray-400">Poli</span>
                    <span class="font-bold text-gray-800" id="success-poli">Poli Umum</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-400">Dokter</span>
                    <span class="font-bold text-gray-800" id="success-dokter">dr. Ryan Kongkap</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-400">Tanggal</span>
                    <span class="font-bold text-gray-800" id="success-tanggal">30 Januari 2050</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-medium text-gray-400">Jam</span>
                    <span class="font-bold text-gray-800" id="success-jam">09:00 - 10:00</span>
                </div>
            </div>
        </div>

        <p class="text-xs text-gray-500 font-semibold text-center italic">Harap datang 15 menit sebelum jadwal</p>

        <!-- Tombol Aksi -->
        <div class="w-full space-y-3 pt-2">
            <button onclick="window.location.href='{{ route('pasien.dashboard') }}?tab=detail-antrean'" class="w-full bg-[#005b66] hover:bg-[#00474d] text-white font-bold py-3 rounded-md text-sm transition-all shadow hover:shadow-md active:scale-[0.99]">
                Lihat Detail Antrean
            </button>
            <button onclick="window.location.href='{{ route('pasien.dashboard') }}?tab=beranda'" class="w-full bg-white border border-teal-600 hover:bg-teal-50 text-[#005b66] font-bold py-3 rounded-md text-sm transition-all shadow-sm active:scale-[0.99]">
                Kembali ke Beranda
            </button>
        </div>
    </div>
</div>
