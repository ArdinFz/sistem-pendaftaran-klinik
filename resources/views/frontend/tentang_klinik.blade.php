<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Klinik - Klinik Tadika Mesra</title>
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
            <h1 class="w-full text-center font-bold text-lg">Tentang Klinik</h1>
        </div>
    </header>

    <!-- Main Container -->
    <main class="flex-1 max-w-[480px] md:max-w-3xl lg:max-w-5xl w-full mx-auto px-5 py-6">
        
        <!-- Profile Card -->
        <div class="bg-white border border-[#005b66]/20 rounded-md p-5 shadow-sm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Sisi Kiri: Profil, Visi, Misi -->
                <div class="space-y-6">
                    <!-- Section: Klinik Bombardiro Crocodilo -->
                    <div class="space-y-2.5">
                        <div>
                            <span class="font-extrabold text-base border-b-2 border-gray-900 pb-0.5 inline-block text-gray-900">Klinik Bombardiro Crocodilo</span>
                        </div>
                        <p class="text-[11px] text-gray-500 font-bold leading-relaxed">
                            Klinik Bombardiro Crocodilo merupakan fasilitas pelayanan kesehatan yang menyediakan layanan pemeriksaan dan konsultasi kesehatan bagi masyarakat secara cepat, mudah, dan nyaman. Klinik ini didukung oleh tenaga medis profesional serta fasilitas pelayanan yang dirancang untuk membantu pasien mendapatkan pelayanan kesehatan yang lebih efektif dan efisien.
                        </p>
                    </div>

                    <!-- Section: Visi -->
                    <div class="space-y-2.5">
                        <div>
                            <span class="font-extrabold text-base border-b-2 border-gray-900 pb-0.5 inline-block text-gray-900">Visi</span>
                        </div>
                        <p class="text-[11px] text-gray-500 font-bold leading-relaxed">
                            Menjadi klinik pelayanan kesehatan yang memberikan layanan medis secara cepat, mudah, dan terpercaya bagi masyarakat.
                        </p>
                    </div>

                    <!-- Section: Misi -->
                    <div class="space-y-2.5">
                        <div>
                            <span class="font-extrabold text-base border-b-2 border-gray-900 pb-0.5 inline-block text-gray-900">Misi</span>
                        </div>
                        <ul class="list-disc pl-5 text-[11px] text-[#1f2937] font-bold space-y-2 leading-relaxed">
                            <li>Memberikan pelayanan kesehatan yang profesional dan ramah.</li>
                            <li>Meningkatkan kualitas pelayanan melalui pemanfaatan teknologi informasi.</li>
                            <li>Membantu pasien memperoleh layanan kesehatan secara efektif dan efisien.</li>
                            <li>Mengutamakan kenyamanan dan kepuasan pasien dalam pelayanan.</li>
                        </ul>
                    </div>
                </div>

                <!-- Sisi Kanan: Jam Operasional, Lokasi, Kontak -->
                <div class="space-y-6">
                    <!-- Section: Jam Operasional -->
                    <div class="space-y-2.5">
                        <div>
                            <span class="font-extrabold text-base border-b-2 border-gray-900 pb-0.5 inline-block text-gray-900">Jam Operasional</span>
                        </div>
                        <div class="flex items-center space-x-2 text-base font-bold text-gray-900 pt-0.5">
                            <!-- Clock Icon SVG -->
                            <svg class="w-5 h-5 text-gray-900" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>08:00 - 20:00 WIB</span>
                        </div>
                    </div>

                    <!-- Section: Lokasi -->
                    <div class="space-y-2.5">
                        <div>
                            <span class="font-extrabold text-base border-b-2 border-gray-900 pb-0.5 inline-block text-gray-900">Lokasi</span>
                        </div>
                        <p class="text-[11px] text-gray-500 font-bold leading-relaxed">
                            Jl. Cibaduyut, Kecamatan Pesugihan, Kabupaten Gorong-gorong, Provinsi Vredeburg
                        </p>
                        <div class="w-full h-auto rounded border border-gray-200 overflow-hidden mt-1">
                            <img src="{{ asset('assets/images/maps.png') }}" alt="Peta Lokasi Klinik" class="w-full h-auto object-contain">
                        </div>
                    </div>

                    <!-- Section: Kontak -->
                    <div class="space-y-2.5">
                        <div>
                            <span class="font-extrabold text-base border-b-2 border-gray-900 pb-0.5 inline-block text-gray-900">Kontak</span>
                        </div>
                        <div class="text-[11px] text-[#1f2937] font-bold space-y-1.5 leading-tight">
                            <p>Instagram : klinik_bombardirocrocodilo</p>
                            <p>Facebook : Klinik Bombardiro Crocodilo</p>
                            <p>Telepon Darurat : 0813668899</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

</body>
</html>
