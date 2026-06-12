<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Klinik - Klinik Tadika Mesra</title>
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
<body class="medical-pattern min-h-screen flex flex-col pb-6 select-none">

    <!-- Header / Top Bar -->
    <header class="bg-[#005b66] text-white py-4 px-6 sticky top-0 z-40 shadow-md">
        <div class="max-w-[480px] md:max-w-3xl lg:max-w-5xl w-full mx-auto flex items-center relative">
            <a href="{{ Auth::guard('pasien')->check() ? route('pasien.dashboard') : route('pasien.home') }}" class="absolute left-0 hover:opacity-80 transition-opacity">
                <!-- Back Arrow SVG -->
                <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h1 class="w-full text-center font-bold text-lg">Layanan Klinik</h1>
        </div>
    </header>

    <!-- Main Container -->
    <main class="flex-1 max-w-[480px] md:max-w-3xl lg:max-w-5xl w-full mx-auto px-5 py-6 space-y-6">
        
        <!-- Section Title -->
        <h2 class="text-lg font-bold text-gray-900 tracking-wide">Daftar Poli</h2>

        <!-- List Poli Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            
            <!-- Poli Umum (Clickable) -->
            <a href="{{ route('pasien.layanan.umum') }}" class="flex items-center justify-between bg-white border border-gray-250 rounded-lg p-4 shadow-sm hover:border-[#005b66]/60 hover:shadow transition-all active:scale-[0.99] group">
                <div class="flex items-center space-x-4">
                    <!-- Icon container -->
                    <div class="w-14 h-14 flex-shrink-0 flex items-center justify-center bg-transparent">
                        <img src="{{ asset('assets/images/poli_umum.png') }}" alt="Poli Umum" class="w-full h-full object-contain">
                    </div>
                    <!-- Text contents -->
                    <div class="space-y-0.5">
                        <h3 class="font-extrabold text-gray-950 text-sm group-hover:text-[#005b66] transition-colors leading-tight">Poli Umum</h3>
                        <p class="text-[11px] text-gray-500 font-bold leading-none">Pelayanan Kesehatan Umum</p>
                    </div>
                </div>
                <!-- Arrow Icon -->
                <div class="text-[#1f2937] transition-transform group-hover:translate-x-0.5">
                    <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </a>

            <!-- Poli Gigi (Disabled/Non-Clickable) -->
            <div class="flex items-center justify-between bg-white border border-gray-250 rounded-lg p-4 shadow-sm">
                <div class="flex items-center space-x-4">
                    <!-- Icon container -->
                    <div class="w-14 h-14 flex-shrink-0 flex items-center justify-center bg-transparent">
                        <img src="{{ asset('assets/images/poli_gigi.png') }}" alt="Poli Gigi" class="w-full h-full object-contain">
                    </div>
                    <!-- Text contents -->
                    <div class="space-y-0.5">
                        <h3 class="font-extrabold text-gray-950 text-sm leading-tight">Poli Gigi</h3>
                        <p class="text-[11px] text-gray-500 font-bold leading-none">Perawatan Kesehatan Gigi</p>
                    </div>
                </div>
                <!-- Arrow Icon -->
                <div class="text-[#1f2937]">
                    <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </div>
            </div>

        </div>

    </main>

</body>
</html>
