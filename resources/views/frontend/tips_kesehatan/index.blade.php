<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tips Kesehatan - Klinik Tadika Mesra</title>
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
    <!-- Header / Top Bar -->
    <header class="bg-[#005b66] text-white py-4 px-6 sticky top-0 z-40 shadow-md">
        <div class="max-w-[480px] md:max-w-3xl lg:max-w-5xl w-full mx-auto flex items-center relative">
            <a href="{{ Auth::guard('pasien')->check() ? route('pasien.dashboard') : route('pasien.home') }}" class="absolute left-0 hover:opacity-80 transition-opacity">
                <!-- Back Arrow SVG -->
                <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h1 class="w-full text-center font-bold text-lg">Tips Kesehatan</h1>
        </div>
    </header>

    <!-- Main Container -->
    <main class="flex-1 max-w-[480px] md:max-w-3xl lg:max-w-5xl w-full mx-auto px-5 py-6">
        
        <!-- Articles List -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- Article Card -->
            <a href="{{ route('pasien.tips-kesehatan.begadang') }}" class="block bg-white border border-[#005b66]/20 rounded-md p-4 shadow-sm hover:border-[#005b66]/60 hover:shadow transition-all active:scale-[0.99] group">
                <div class="flex justify-between items-start">
                    <h3 class="font-extrabold text-sm text-gray-950 group-hover:text-[#005b66] transition-colors leading-snug">
                        Terlalu Sering Begadang?<br>Ini Dampaknya pada Tubuh
                    </h3>
                    <div class="text-[#1f2937] pt-0.5 group-hover:translate-x-0.5 transition-transform">
                        <!-- Arrow SVG -->
                        <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
                <!-- Image container -->
                <div class="w-full mt-3 overflow-hidden rounded border border-gray-150">
                    <img src="{{ asset('assets/images/tips_begadang.png') }}" alt="Ilustrasi Begadang" class="w-full h-auto object-cover">
                </div>
            </a>

        </div>

    </main>

</body>
</html>
