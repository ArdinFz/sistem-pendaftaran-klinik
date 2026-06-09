<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klinik Tadika Mesra</title>
    <!-- Tailwind CSS & Google Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
        /* Pola background bernuansa medis kustom */
        .medical-pattern {
            background-color: #ffffff;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 80 80'%3E%3Cg fill='%23005b66' fill-opacity='0.03'%3E%3Cpath d='M15 15h10v2h-10zm25 35h10v2h-10z'/%3E%3Ccircle cx='55' cy='20' r='3'/%3E%3Ccircle cx='20' cy='60' r='3'/%3E%3Crect x='35' y='15' width='6' height='6' rx='2'/%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="medical-pattern min-h-screen flex flex-col items-center justify-center p-6">

    <!-- Wrapper Utama (Maksimal Lebar untuk Sentralisasi) -->
    <div class="w-full max-w-lg flex flex-col items-center text-center space-y-8">
        
        <!-- Bagian Logo & Judul -->
        <div class="flex flex-col items-center space-y-4">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Klinik" class="h-20 w-auto">
            <h1 class="text-3xl font-bold text-gray-800 tracking-wide">Klinik Tadika Mesra</h1>
        </div>

        <!-- Bagian Ilustrasi Dokter -->
        <div class="w-full max-w-sm">
            <img src="{{ asset('assets/images/doctor.png') }}" alt="Ilustrasi Dokter" class="w-full h-auto mx-auto drop-shadow-sm">
        </div>

        <!-- Tombol Masuk -->
        <div class="w-full px-4">
            <a href="{{ route('login') }}" 
                class="block w-full text-center bg-[#005b66] hover:bg-[#004a54] text-white font-bold py-4 px-6 rounded-lg text-xl transition-all shadow-md hover:shadow-lg active:scale-[0.98]">
                Masuk
            </a>
        </div>

    </div>

</body>
</html>
