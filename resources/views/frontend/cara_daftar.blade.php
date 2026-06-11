<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara Daftar - Klinik Tadika Mesra</title>
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
    <header class="bg-[#005b66] text-white py-4 px-6 flex items-center relative sticky top-0 z-40 shadow-md max-w-[480px] mx-auto w-full">
        <a href="{{ Auth::guard('pasien')->check() ? route('pasien.dashboard') : route('pasien.home') }}" class="absolute left-6 hover:opacity-80 transition-opacity">
            <!-- Back Arrow SVG -->
            <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
        <h1 class="w-full text-center font-bold text-lg">Cara Daftar</h1>
    </header>

    <!-- Main Container -->
    <main class="flex-1 max-w-[480px] w-full mx-auto px-5 py-6">
        
        <!-- Info Card -->
        <div class="bg-white border border-[#005b66]/20 rounded-md p-5 shadow-sm space-y-6">
            
            <!-- Title -->
            <div>
                <span class="font-extrabold text-base border-b-2 border-gray-900 pb-0.5 inline-block text-gray-900">Cara Daftar Antrean Online</span>
            </div>

            <!-- Steps -->
            <ol class="list-decimal pl-5 text-[11px] text-[#1f2937] font-bold space-y-2.5 leading-relaxed">
                <li>Buat akun, tekan tombol “Daftar”</li>
                <li>Setelah akun terbuat, anda akan otomatis ke Beranda</li>
                <li>Yaudah tinggal pencet tombol “Daftar Antrean”</li>
                <li>Isi semua data mulai dari poli, dokter, jadwal kunjungan serta keluhan</li>
                <li>Pencat tombol “Simpan”</li>
                <li>Udah, otomatis nyimpen itu</li>
                <li>Selamat, Anda sudah terdaftar</li>
                <li>Yeyyyy</li>
            </ol>

            <!-- Illustration -->
            <div class="w-full max-w-[280px] mx-auto flex justify-center items-center pt-4">
                <img src="{{ asset('assets/images/doctor_patient.png') }}" alt="Ilustrasi Cara Daftar" class="w-full h-auto object-contain">
            </div>

        </div>

    </main>

</body>
</html>
