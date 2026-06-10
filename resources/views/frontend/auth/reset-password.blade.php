<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Password Baru - Klinik Tadika Mesra</title>
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
<body class="medical-pattern min-h-screen flex flex-col">

    <!-- Header / Top Bar -->
    <header class="bg-[#005b66] text-white py-4 px-6 flex items-center shadow-md">
        <a href="{{ route('pasien.password.forgot.verify') }}" class="hover:opacity-80 transition-opacity">
            <!-- Back Arrow SVG -->
            <svg class="w-6 h-6 stroke-current" fill="none" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
    </header>

    <!-- Main Container -->
    <main class="flex-1 flex flex-col items-center justify-center p-6">
        <div class="w-full max-w-md bg-white border border-teal-600 rounded-lg p-6 shadow-sm">
            
            <!-- Header Text -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-[#005b66] mb-1">Buat Password Baru</h1>
                <p class="text-sm font-medium text-teal-800">
                    Ribet ya? makanya ingat-ingat password kocak!, dasar ingatan tua bangka !
                </p>
            </div>

            <!-- Alert Session / Error -->
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-md text-sm">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('pasien.password.forgot.reset.save') }}" method="POST" class="space-y-4">
                @csrf
                
                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-[#005b66] mb-1">Password</label>
                    <input type="password" name="password" id="password" placeholder="Masukkan password baru..." required
                        class="w-full px-3 py-2.5 border border-teal-600 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 font-medium text-gray-700 text-sm">
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-[#005b66] mb-1">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ulangi password baru..." required
                        class="w-full px-3 py-2.5 border border-teal-600 rounded-md focus:outline-none focus:ring-2 focus:ring-teal-500 font-medium text-gray-700 text-sm">
                </div>

                <!-- Tombol Simpan Password -->
                <button type="submit" 
                    class="w-full bg-[#005b66] hover:bg-[#004a54] text-white font-bold py-2.5 px-4 rounded-md transition-all shadow hover:shadow-md active:scale-[0.99] text-sm">
                    Simpan Password
                </button>
            </form>

        </div>
    </main>

</body>
</html>
