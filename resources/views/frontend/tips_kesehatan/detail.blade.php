<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terlalu Sering Begadang? Ini Dampaknya pada Tubuh - Klinik Tadika Mesra</title>
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
            <a href="{{ route('pasien.tips-kesehatan') }}" class="absolute left-0 hover:opacity-80 transition-opacity">
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
        
        <!-- Detail Card -->
        <div class="bg-white border border-[#005b66]/20 rounded-md p-5 shadow-sm">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                <!-- Title & Image -->
                <div class="lg:col-span-5 space-y-4">
                    <h2 class="text-center lg:text-left font-extrabold text-gray-950 text-base leading-snug">
                        Terlalu Sering Begadang?<br>Ini Dampaknya pada Tubuh
                    </h2>
                    <div class="w-full overflow-hidden rounded border border-gray-150">
                        <img src="{{ asset('assets/images/tips_begadang.png') }}" alt="Begadang" class="w-full h-auto object-cover">
                    </div>
                </div>

                <!-- Content Body -->
                <div class="lg:col-span-7 space-y-4 text-[11px] text-gray-700 font-bold leading-relaxed">
                    
                    <!-- Section 1 -->
                    <div class="space-y-1">
                        <h3 class="text-xs font-extrabold text-gray-950">1. Sulit Konsentrasi</h3>
                        <p class="font-bold">
                            Bahaya begadang bagi tubuh yang pertama adalah sulit berkonsentrasi. Memiliki waktu tidur yang cukup dapat bermanfaat bagi proses berpikir dan belajar. Kurangnya waktu tidur dapat menurunkan kewaspadaan, konsentrasi, nalar serta kemampuan memecahkan masalah. Bukan itu saja, kurang tidur juga dapat menurunkan daya ingat seseorang.
                        </p>
                    </div>

                    <!-- Section 2 -->
                    <div class="space-y-1">
                        <h3 class="text-xs font-extrabold text-gray-950">2. Rentan Mengalami Kecelakaan</h3>
                        <p class="font-bold">
                            Rentan mengalami kecelakaan menjadi bahaya begadang bagi tubuh selanjutnya. Kurang tidur akan membuat kamu merasa kantuk pada siang hari. Jika kamu pergi bekerja menggunakan kendaraan pribadi, kecelakaan bisa saja terjadi. Bukan hanya kecelakaan saat pergi bekerja saja, kurang tidur juga dapat menyebabkan kecelakaan dan cedera saat bekerja.
                        </p>
                    </div>

                    <!-- Section 3 -->
                    <div class="space-y-2">
                        <h3 class="text-xs font-extrabold text-gray-950">3. Munculnya Penyakit Serius</h3>
                        <p class="font-bold">
                            Begadang menjadi penyebab sejumlah masalah berbahaya bagi tubuh. Beberapa penyakit yang membahayakan tubuh akibat begadang, antara lain:
                        </p>
                        <ul class="list-disc pl-5 font-bold space-y-1 text-gray-700">
                            <li>Stroke;</li>
                            <li>Diabetes;</li>
                            <li>Penyakit jantung;</li>
                            <li>Serangan jantung;</li>
                            <li>Gagal jantung;</li>
                            <li>Peningkatan detak jantung;</li>
                            <li>Tekanan darah tinggi;</li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>

    </main>

</body>
</html>
