<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Tadika Mesra - Selamat Datang</title>
    <!-- Tailwind CSS & Google Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
        .medical-pattern {
            background-color: #ffffff;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 80 80'%3E%3Cg fill='%23005b66' fill-opacity='0.03'%3E%3Cpath d='M15 15h10v2h-10zm25 35h10v2h-10z'/%3E%3Ccircle cx='55' cy='20' r='3'/%3E%3Ccircle cx='20' cy='60' r='3'/%3E%3Crect x='35' y='15' width='6' height='6' rx='2'/%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="medical-pattern min-h-screen flex flex-col items-center justify-center p-6">

    <!-- Header / Top Bar for Navigation Back -->
    <div class="w-full max-w-md mb-4 flex justify-start">
        <a href="{{ route('pasien.home') }}" class="text-[#005b66] hover:opacity-80 transition-opacity flex items-center space-x-1.5 font-bold text-sm">
            <!-- Back Arrow SVG -->
            <svg class="w-5 h-5 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            <span>Kembali ke Beranda</span>
        </a>
    </div>

    <!-- Wrapper Utama -->
    <div class="w-full max-w-md bg-white border border-teal-600 rounded-md p-6 shadow-sm flex flex-col items-center text-center space-y-8">
        
        <!-- Bagian Logo & Judul -->
        <div class="flex flex-col items-center space-y-3">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Klinik" class="h-20 w-auto object-contain">
            <h1 class="text-3xl font-extrabold text-[#005b66] tracking-wide">Klinik Tadika Mesra</h1>
        </div>

        <!-- Bagian Ilustrasi Dokter -->
        <div class="w-full max-w-xs py-2">
            <img src="{{ asset('assets/images/doctor.png') }}" alt="Ilustrasi Dokter" class="w-full h-auto mx-auto drop-shadow-sm">
        </div>

        <!-- Tombol Masuk & Daftar -->
        <div class="w-full space-y-4">
            <a href="{{ route('pasien.login') }}" 
                class="block w-full text-center bg-[#005b66] hover:bg-[#004a54] text-white font-bold py-3 px-6 rounded-md text-base transition-all shadow hover:shadow-md active:scale-[0.98]">
                Masuk
            </a>
            
            <a href="{{ route('pasien.register') }}" 
                class="block w-full text-center bg-[#005b66] hover:bg-[#004a54] text-white font-bold py-3 px-6 rounded-md text-base transition-all shadow hover:shadow-md active:scale-[0.98]">
                Daftar
            </a>
        </div>

    </div>

</body>
</html>
