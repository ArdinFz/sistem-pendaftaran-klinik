<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Informasi Klinik</title>
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
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 80 80'%3E%3Cg fill='%23005b66' fill-opacity='0.04'%3E%3Cpath d='M15 15h10v2h-10zm25 35h10v2h-10z'/%3E%3Ccircle cx='55' cy='20' r='3'/%3E%3Ccircle cx='20' cy='60' r='3'/%3E%3Crect x='35' y='15' width='6' height='6' rx='2'/%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-[#005b66] min-h-screen flex flex-col">

    <!-- Header / Top Bar dengan tombol kembali -->
    <header class="h-16 bg-[#005b66] flex items-center px-6">
        <a href="{{ url('/') }}" class="text-white hover:text-gray-200 transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
    </header>

    <!-- Main Container Layout -->
    <div class="flex-1 medical-pattern flex items-center justify-center p-6 md:p-12">
        <div class="w-full max-w-6xl grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            
            <!-- Sisi Kiri: Ilustrasi Medis Perawat & Pasien Asli -->
            <div class="hidden md:block">
                <img src="{{ asset('assets/images/nurse_patient.png') }}" alt="Ilustrasi Perawat dan Pasien" class="w-full h-auto mx-auto max-w-lg drop-shadow-sm">
            </div>

            <!-- Sisi Kanan: Form Login -->
            <div class="bg-white md:bg-transparent p-8 md:p-0 rounded-2xl md:rounded-none shadow-xl md:shadow-none max-w-md mx-auto w-full">
                <!-- Alert Error jika input salah -->
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg text-sm" role="alert">
                        {{ $errors->first() }}
                    </div>
                @endif

                <!-- Alert Sukses -->
                @if (session('success'))
                    <div class="mb-4 bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-r-lg text-sm" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('authenticate') }}" method="POST" class="space-y-6">
                    @csrf
                    <!-- Input Email / Nomor HP -->
                    <div>
                        <label for="email" class="block text-xl font-medium text-[#005b66] mb-2">Email/Nomor Hp</label>
                        <input type="text" name="email" id="email" value="{{ old('email') }}" required
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg text-lg focus:outline-none focus:border-[#005b66] transition-colors bg-white">
                    </div>

                    <!-- Input Password -->
                    <div>
                        <label for="password" class="block text-xl font-medium text-[#005b66] mb-2">Password</label>
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg text-lg focus:outline-none focus:border-[#005b66] transition-colors bg-white">
                    </div>

                    <!-- Tombol Masuk -->
                    <button type="submit" 
                        class="w-full bg-[#005b66] hover:bg-[#004a54] text-white font-bold py-4 px-6 rounded-lg text-xl transition-colors shadow-md active:scale-[0.98]">
                        Masuk
                    </button>

                    <!-- Lupa Kata Sandi Link -->
                    <div class="text-right">
                        <a href="{{ route('password.forgot') }}" class="text-[#005b66] hover:underline font-medium text-lg">
                            Lupa Kata Sandi?
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>

</body>
</html>