<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Tadika Mesra - Portal Antrean</title>
    <!-- Tailwind CSS & Google Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
        /* Pola background bernuansa medis kustom */
        .medical-pattern {
            background-color: #f8fafc;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 80 80'%3E%3Cg fill='%23005b66' fill-opacity='0.02'%3E%3Cpath d='M15 15h10v2h-10zm25 35h10v2h-10z'/%3E%3Ccircle cx='55' cy='20' r='3'/%3E%3Ccircle cx='20' cy='60' r='3'/%3E%3Crect x='35' y='15' width='6' height='6' rx='2'/%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="medical-pattern min-h-screen flex flex-col pb-24 select-none">

    <!-- Header / Top Bar -->
    <header class="bg-white border-b border-gray-100 py-3.5 px-6 sticky top-0 z-40 shadow-sm">
        <div class="max-w-[480px] md:max-w-3xl lg:max-w-5xl w-full mx-auto flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Klinik" class="h-10 w-auto object-contain">
            <span class="text-lg font-bold text-[#005b66] tracking-wide">Klinik Tadika Mesra</span>
        </div>

        <!-- Masuk/Daftar Button -->
        <div>
            @auth('pasien')
                <a href="{{ route('pasien.dashboard') }}" class="flex items-center space-x-2 bg-teal-50 text-[#005b66] border border-teal-100 px-4 py-2 rounded-md text-sm font-bold shadow-sm hover:bg-teal-100 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Halo, {{ explode(' ', Auth::guard('pasien')->user()->nama)[0] }}</span>
                </a>
            @else
                <a href="{{ route('pasien.welcome') }}" class="flex items-center space-x-1.5 text-[#005b66] hover:opacity-85 text-base font-bold transition-opacity">
                    <!-- Login icon SVG (Arrow pointing right to text) -->
                    <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l4-4m0 0l-4-4m4 4H3m5-4V7a3 3 0 013-3h7a3 3 0 013 3v10a3 3 0 01-3 3h-7a3 3 0 01-3-3v-1" />
                    </svg>
                    <span>Masuk/Daftar</span>
                </a>
            @endauth
        </div>
    </div>
</header>

    <!-- Main Container -->
    <main class="flex-1 max-w-[480px] md:max-w-3xl lg:max-w-5xl w-full mx-auto px-5 py-6 space-y-6">
        
        <!-- Top Cards: Antrean Online & Cek Antrean (Sized as original design) -->
        <div class="grid grid-cols-2 gap-4">
            
            <!-- Antrean Online Card (Solid Teal, rounded-md) -->
            <div class="bg-[#005b66] text-white rounded-md p-4 flex flex-col justify-between shadow-md border border-teal-700 min-h-[155px]">
                <div class="space-y-1.5">
                    <div class="flex items-center space-x-1.5">
                        <!-- Calendar Icon (White) -->
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span class="font-bold text-sm tracking-wide border-b border-teal-500 pb-0.5">Antrean Online</span>
                    </div>
                    <p class="text-[11px] text-teal-100 leading-relaxed">Ambil antrean tanpa perlu datang langsung ke klinik</p>
                </div>
                
                @auth('pasien')
                    <a href="{{ route('pasien.dashboard') }}" class="w-full text-center bg-white text-[#005b66] hover:bg-teal-50 transition-colors font-bold py-2 rounded-md text-xs shadow-sm mt-3">
                        Daftar Antrean
                    </a>
                @else
                    <button onclick="openAuthModal()" class="w-full bg-white text-[#005b66] hover:bg-teal-50 transition-colors font-bold py-2 rounded-md text-xs shadow-sm mt-3">
                        Daftar Antrean
                    </button>
                @endauth
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
                
                <button onclick="openAuthModal()" class="w-full bg-[#005b66] text-white hover:bg-[#004a54] transition-colors font-bold py-2 rounded-md text-xs shadow-sm mt-3">
                    Cek Antrean
                </button>
            </div>

        </div>

        <!-- Middle Grid: 6 Items -->
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

            <!-- SOS (Statis / No action) -->
            <div class="bg-white border border-red-500 rounded-md p-2.5 flex flex-col items-center justify-center space-y-1.5 shadow-sm">
                <div class="w-12 h-12 flex items-center justify-center bg-red-600 rounded-full shadow-inner">
                    <span class="text-white font-extrabold text-sm">SOS</span>
                </div>
                <span class="text-[10px] font-bold text-red-600 text-center leading-tight">SOS</span>
            </div>

        </div>

        <!-- Pengumuman Section (Image loaded directly, scrollable layout) -->
        <div class="space-y-3 pb-6">
            <h3 class="text-base font-extrabold text-[#005b66] tracking-wide border-l-4 border-[#005b66] pl-2">| Pengumuman</h3>
            
            <div class="w-full">
                <img src="{{ asset('assets/images/pengumuman.png') }}" alt="Pengumuman Libur" class="w-full h-auto rounded-md shadow-sm border border-gray-250">
            </div>
        </div>

    </main>

    <!-- Bottom Navigation Bar (Sticky/Fixed) -->
    <nav class="fixed bottom-0 left-0 right-0 max-w-[480px] md:max-w-3xl lg:max-w-5xl mx-auto bg-[#005b66] text-teal-100 flex h-16 shadow-lg z-30 border-t border-[#004d57] md:rounded-t-xl">
        
        <!-- Beranda (Active) -->
        <a href="{{ route('pasien.home') }}" class="flex-1 h-full flex flex-col items-center justify-center space-y-0.5 text-white bg-[#1a2c35] border-r border-[#004d57]">
            <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2.2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="text-[10px] font-bold">Beranda</span>
        </a>

        <!-- Antrean -->
        @auth('pasien')
            <a href="{{ route('pasien.dashboard') }}" class="flex-1 h-full flex flex-col items-center justify-center space-y-0.5 hover:text-white transition-colors bg-[#005b66] border-r border-[#004d57]">
                <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <span class="text-[10px] font-semibold">Antrean</span>
            </a>
        @else
            <button onclick="openAuthModal()" class="flex-1 h-full flex flex-col items-center justify-center space-y-0.5 hover:text-white transition-colors bg-[#005b66] border-r border-[#004d57]">
                <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <span class="text-[10px] font-semibold">Antrean</span>
            </button>
        @endauth

        <!-- Riwayat -->
        @auth('pasien')
            <a href="{{ route('pasien.dashboard') }}" class="flex-1 h-full flex flex-col items-center justify-center space-y-0.5 hover:text-white transition-colors bg-[#005b66] border-r border-[#004d57]">
                <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-[10px] font-semibold">Riwayat</span>
            </a>
        @else
            <button onclick="openAuthModal()" class="flex-1 h-full flex flex-col items-center justify-center space-y-0.5 hover:text-white transition-colors bg-[#005b66] border-r border-[#004d57]">
                <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-[10px] font-semibold">Riwayat</span>
            </button>
        @endauth

        <!-- Akun -->
        @auth('pasien')
            <a href="{{ route('pasien.dashboard') }}" class="flex-1 h-full flex flex-col items-center justify-center space-y-0.5 hover:text-white transition-colors bg-[#005b66]">
                <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-[10px] font-semibold">Akun</span>
            </a>
        @else
            <button onclick="openAuthModal()" class="flex-1 h-full flex flex-col items-center justify-center space-y-0.5 hover:text-white transition-colors bg-[#005b66]">
                <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span class="text-[10px] font-semibold">Akun</span>
            </button>
        @endauth

    </nav>

    <!-- Modal Alert / Auth Popup (Notifikasi Guest) -->
    <div id="authModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300">
        
        <!-- Modal Card (rounded-md) -->
        <div class="bg-white rounded-md w-full max-w-sm p-6 shadow-2xl border border-gray-150 transform scale-95 transition-transform duration-300 relative flex flex-col items-center text-center space-y-5">
            
            <!-- Close Button (Pojok Kanan Atas) -->
            <button onclick="closeAuthModal()" class="absolute right-4 top-4 text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Vector Illustration of Lady pointing down (Enlarged by ~12%) -->
            <div class="w-[180px] h-auto">
                <img src="{{ asset('assets/images/unauthorized_alert.png') }}" alt="Peringatan Autentikasi" class="w-full h-auto object-contain">
            </div>

            <!-- Content Message -->
            <div class="space-y-2 px-2">
                <p class="text-sm font-semibold text-gray-700 leading-relaxed">
                    Untuk melakukan daftar antrean secara online, harap masuk atau daftar akun terlebih dahulu
                </p>
            </div>

            <!-- Action Buttons (Masuk & Daftar, rounded-md) -->
            <div class="grid grid-cols-2 gap-3 w-full pt-2">
                <a href="{{ route('pasien.login') }}" class="w-full bg-[#005b66] hover:bg-[#00474d] text-white font-bold py-2.5 rounded-md text-sm transition-all shadow hover:shadow-md active:scale-[0.98]">
                    Masuk
                </a>
                <a href="{{ route('pasien.register') }}" class="w-full bg-[#005b66] hover:bg-[#00474d] text-white font-bold py-2.5 rounded-md text-sm transition-all shadow hover:shadow-md active:scale-[0.98]">
                    Daftar
                </a>
            </div>

        </div>
    </div>

    <!-- JavaScript for Modal Interactions -->
    <script>
        const modal = document.getElementById('authModal');
        const modalContainer = modal.querySelector('div');

        function openAuthModal() {
            modal.classList.remove('hidden');
            // Allow layout to render first before triggering animation
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modalContainer.classList.remove('scale-95');
                modalContainer.classList.add('scale-100');
            }, 50);
        }

        function closeAuthModal() {
            modal.classList.add('opacity-0');
            modalContainer.classList.remove('scale-100');
            modalContainer.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // Close when clicking backdrop
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeAuthModal();
            }
        });
    </script>

</body>
</html>
