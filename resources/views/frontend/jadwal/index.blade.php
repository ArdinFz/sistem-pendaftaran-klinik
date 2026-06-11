<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Dokter - Klinik Tadika Mesra</title>
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
        /* Hide scrollbars for chrome/safari/opera */
        .scrollbar-none::-webkit-scrollbar {
            display: none;
        }
        /* Hide scrollbar for ie/edge/firefox */
        .scrollbar-none {
            -ms-overflow-style: none;
            scrollbar-width: none;
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
        <h1 class="w-full text-center font-bold text-lg">Jadwal Dokter</h1>
    </header>

    <!-- Main Container -->
    <main class="flex-1 max-w-[480px] w-full mx-auto px-5 py-6 space-y-6">

        @php
            $dayMap = [
                1 => 'Sen',
                2 => 'Sel',
                3 => 'Rab',
                4 => 'Kam',
                5 => 'Jum',
                6 => 'Sab',
                7 => 'Min'
            ];
            $monthMap = [
                1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun',
                7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'
            ];
        @endphp

        @if ($dates->isEmpty())
            <!-- Empty State Database -->
            <div class="bg-white border border-[#005b66]/20 rounded-md p-8 text-center shadow-sm space-y-3">
                <div class="w-16 h-16 mx-auto text-gray-300">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h12.75A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h12.75A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                </div>
                <p class="text-sm font-semibold text-gray-500">Tidak ada jadwal dokter yang terdaftar saat ini.</p>
            </div>
        @else
            <!-- Horizontal Date Selector -->
            <div class="flex space-x-3 overflow-x-auto pb-4 scrollbar-none">
                @foreach ($dates as $index => $date)
                    @php
                        $dateStr = $date->format('Y-m-d');
                        $dayNum = (int)$date->format('N');
                        $monthNum = (int)$date->format('m');
                        $dayName = $dayMap[$dayNum] ?? 'Sen';
                        $monthName = $monthMap[$monthNum] ?? 'Mei';
                        $formattedDate = $date->format('d') . ' ' . $monthName;
                        $isActive = $index === 0;
                    @endphp

                    <div onclick="selectDate('{{ $dateStr }}', this)" 
                         class="date-card flex-shrink-0 w-24 p-3 rounded-lg text-center shadow-sm cursor-pointer transition-all duration-200 
                                {{ $isActive 
                                    ? 'bg-[#005b66] text-white border-none' 
                                    : 'bg-white text-gray-900 border border-gray-250 hover:bg-teal-50/30' }}">
                        <span class="block font-extrabold text-base mb-0.5">{{ $dayName }}</span>
                        <span class="block text-xs font-bold {{ $isActive ? 'text-teal-50' : 'text-gray-500' }} date-label">{{ $formattedDate }}</span>
                    </div>
                @endforeach
            </div>

            <!-- Schedules List Grouped by Date -->
            <div class="space-y-4">
                @foreach ($groupedSchedules as $dateStr => $daySchedules)
                    <div id="schedule-date-{{ $dateStr }}" class="schedule-group space-y-4 {{ $loop->first ? '' : 'hidden' }}">
                        @foreach ($daySchedules as $schedule)
                            <div class="bg-white border border-gray-250 rounded-lg p-4 flex items-center space-x-4 shadow-sm">
                                <!-- Avatar outline circle -->
                                <div class="w-14 h-14 rounded-full border-2 border-gray-200 flex-shrink-0 flex items-center justify-center bg-gray-50 text-gray-400">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <!-- Content Details -->
                                <div class="flex-1 min-w-0">
                                    <h3 class="font-extrabold text-gray-950 text-base leading-tight">{{ $schedule->dokter }}</h3>
                                    <p class="text-xs text-gray-500 font-bold leading-normal mt-0.5">{{ $schedule->poliklinik }}</p>
                                    <span class="bg-[#005b66] text-white text-[11px] font-bold px-3 py-1 rounded inline-block mt-2.5">
                                        {{ date('H:i', strtotime($schedule->jam_mulai)) }} - {{ date('H:i', strtotime($schedule->jam_selesai)) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endif

    </main>

    <!-- JavaScript dynamic day selection -->
    <script>
        function selectDate(dateStr, cardElement) {
            // Hide all schedule groups
            const groups = document.querySelectorAll('.schedule-group');
            groups.forEach(g => g.classList.add('hidden'));

            // Show selected schedule group
            const selectedGroup = document.getElementById('schedule-date-' + dateStr);
            if (selectedGroup) {
                selectedGroup.classList.remove('hidden');
            }

            // Reset all date cards classes
            const cards = document.querySelectorAll('.date-card');
            cards.forEach(c => {
                c.className = "date-card flex-shrink-0 w-24 p-3 rounded-lg text-center shadow-sm cursor-pointer transition-all duration-200 bg-white text-gray-900 border border-gray-250 hover:bg-teal-50/30";
                const label = c.querySelector('.date-label');
                if (label) {
                    label.classList.remove('text-teal-50');
                    label.classList.add('text-gray-500');
                }
            });

            // Set active class to clicked card
            cardElement.className = "date-card flex-shrink-0 w-24 p-3 rounded-lg text-center shadow-sm cursor-pointer transition-all duration-200 bg-[#005b66] text-white border-none";
            const activeLabel = cardElement.querySelector('.date-label');
            if (activeLabel) {
                activeLabel.classList.remove('text-gray-500');
                activeLabel.classList.add('text-teal-50');
            }
        }
    </script>

</body>
</html>
