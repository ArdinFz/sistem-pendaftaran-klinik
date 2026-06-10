<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi OTP - Sistem Informasi Klinik</title>
    <!-- Tailwind CSS & Google Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
        .medical-pattern {
            background-color: #f8fafc;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='80' height='80' viewBox='0 0 80 80'%3E%3Cg fill='%23005b66' fill-opacity='0.04'%3E%3Cpath d='M15 15h10v2h-10zm25 35h10v2h-10z'/%3E%3Ccircle cx='55' cy='20' r='3'/%3E%3Ccircle cx='20' cy='60' r='3'/%3E%3Crect x='35' y='15' width='6' height='6' rx='2'/%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-white min-h-screen flex flex-col">

    <!-- Header dengan tombol kembali teal -->
    <header class="h-16 bg-white flex items-center px-6">
        <a href="{{ route('password.forgot') }}" class="text-[#005b66] hover:text-[#004a54] transition-colors">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
        </a>
    </header>

    <!-- Main Container Layout -->
    <div class="flex-1 medical-pattern flex items-center justify-center p-6 md:p-12">
        <div class="w-full max-w-6xl grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            
            <!-- Sisi Kiri: Form Verifikasi OTP -->
            <div class="bg-white md:bg-transparent p-8 md:p-0 rounded-2xl md:rounded-none shadow-xl md:shadow-none max-w-md mx-auto w-full">
                <h2 class="text-3xl font-bold text-[#005b66] mb-2">Verifikasi Kode</h2>
                <p class="text-gray-600 mb-8">
                    Masukkan 4 digit kode OTP yang telah dikirimkan ke 
                    <span class="font-semibold text-gray-800">{{ session('reset_email') }}</span>.
                </p>

                <!-- Alert Error -->
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-lg text-sm" role="alert">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('password.forgot.verify.check') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-xl font-medium text-[#005b66] mb-4 text-center">Kode Verifikasi</label>
                        <div class="flex justify-between gap-2 max-w-xs mx-auto">
                            <input type="text" name="otp[]" maxlength="1" required class="otp-input w-16 h-16 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg focus:outline-none focus:border-[#005b66] transition-colors bg-white">
                            <input type="text" name="otp[]" maxlength="1" required class="otp-input w-16 h-16 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg focus:outline-none focus:border-[#005b66] transition-colors bg-white">
                            <input type="text" name="otp[]" maxlength="1" required class="otp-input w-16 h-16 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg focus:outline-none focus:border-[#005b66] transition-colors bg-white">
                            <input type="text" name="otp[]" maxlength="1" required class="otp-input w-16 h-16 text-center text-2xl font-bold border-2 border-gray-300 rounded-lg focus:outline-none focus:border-[#005b66] transition-colors bg-white">
                        </div>
                    </div>

                    <!-- Tombol Periksa -->
                    <button type="submit" 
                        class="w-full bg-[#005b66] hover:bg-[#004a54] text-white font-bold py-4 px-6 rounded-lg text-xl transition-colors shadow-md active:scale-[0.98]">
                        Periksa
                    </button>
                </form>
            </div>

            <!-- Sisi Kanan: Ilustrasi Medis Dokter Asli -->
            <div class="hidden md:block">
                <img src="{{ asset('assets/images/doctor.png') }}" alt="Ilustrasi Dokter" class="w-full h-auto mx-auto max-w-lg drop-shadow-sm">
            </div>

        </div>
    </div>

    <script>
        const inputs = document.querySelectorAll('.otp-input');
        inputs.forEach((input, index) => {
            input.addEventListener('input', (e) => {
                if (!/^[0-9]$/.test(e.target.value)) {
                    e.target.value = '';
                    return;
                }
                if (e.target.value && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
            });
            input.addEventListener('keydown', (e) => {
                if (e.key === 'Backspace' && !e.target.value && index > 0) {
                    inputs[index - 1].focus();
                }
            });
        });
    </script>
</body>
</html>
