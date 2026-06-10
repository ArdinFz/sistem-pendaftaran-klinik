<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Pasien - Klinik Tadika Mesra</title>
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
<body class="medical-pattern min-h-screen flex flex-col pb-24 select-none">

    <!-- Header / Top Bar -->
    @include('frontend.layouts.top_bar')

    <!-- Main Container -->
    <main class="flex-1 max-w-[480px] w-full mx-auto px-5 py-6">
        @yield('content')
    </main>

    <!-- Bottom Navigation Bar (Sticky/Fixed) -->
    @include('frontend.layouts.bottom_navbar')

    <!-- JavaScript for Tab Switching & AJAX Operations -->
    <script>
        function switchTab(tabName) {
            // Hide all tab contents
            const contents = document.querySelectorAll('.tab-content');
            contents.forEach(content => content.classList.add('hidden'));

            // Show selected tab content
            const activeContent = document.getElementById('content-' + tabName);
            if (activeContent) {
                activeContent.classList.remove('hidden');
            }

            // Reset all nav buttons class
            const navButtons = document.querySelectorAll('.nav-btn');
            navButtons.forEach(btn => {
                btn.classList.remove('text-white', 'bg-[#1a2c35]');
                btn.classList.add('text-teal-100', 'bg-[#005b66]');
                btn.querySelector('span').classList.remove('font-bold');
                btn.querySelector('span').classList.add('font-semibold');
            });

            // Set active nav button style (map sub-tabs to main Antrean button)
            let activeTabName = tabName;
            if (tabName === 'daftar-antrean' || tabName === 'detail-antrean') {
                activeTabName = 'antrean';
            }

            const activeBtn = document.getElementById('nav-btn-' + activeTabName);
            if (activeBtn) {
                activeBtn.classList.remove('text-teal-100', 'bg-[#005b66]');
                activeBtn.classList.add('text-white', 'bg-[#1a2c35]');
                activeBtn.querySelector('span').classList.remove('font-semibold');
                activeBtn.querySelector('span').classList.add('font-bold');
            }

            // Toggle global header visibility
            const globalHeader = document.getElementById('global-header');
            if (globalHeader) {
                if (tabName === 'akun') {
                    globalHeader.classList.add('hidden');
                } else {
                    globalHeader.classList.remove('hidden');
                }
            }

            // Scroll window to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // On page load, route to the correct tab if specified in URL query params
        window.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const tabParam = urlParams.get('tab');
            if (tabParam) {
                switchTab(tabParam);
            }
        });

        // AJAX: Load Doctor Schedules based on selected Poli and Date
        function loadDoctorSchedules() {
            const poliId = document.getElementById('select-poli').value;
            const dateVal = document.getElementById('select-date').value;
            const dokterSelect = document.getElementById('select-dokter');
            const infoText = document.getElementById('schedule-info-text');

            // Reset dropdown
            dokterSelect.innerHTML = '<option value="">Pilih Jadwal Dokter</option>';
            infoText.classList.add('hidden');
            infoText.innerText = '';

            if (!poliId) return;

            // Fetch schedules via AJAX
            let url = `{{ route('pasien.get-schedules') }}?id_poli=${poliId}`;
            if (dateVal) {
                url += `&tanggal=${dateVal}`;
            }

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        dokterSelect.innerHTML = '<option value="">Tidak ada dokter bertugas</option>';
                        infoText.classList.remove('hidden');
                        infoText.innerHTML = 'Tidak ada dokter yang bertugas pada kriteria ini.<br>Tip: Coba tanggal <strong>2026-06-10</strong> atau <strong>2026-06-08</strong> sesuai jadwal master.';
                    } else {
                        data.forEach(sched => {
                            const option = document.createElement('option');
                            option.value = sched.id_jadwal;
                            option.text = `${sched.nama_dokter} (${sched.jam_mulai} - ${sched.jam_selesai}) - ${sched.hari}, ${sched.tanggal_formatted}`;
                            dokterSelect.appendChild(option);
                        });
                    }
                })
                .catch(err => {
                    console.error('Error fetching doctor schedules:', err);
                });
        }

        // AJAX POST: Submit Pendaftaran to Database
        function submitRealPendaftaran(e) {
            e.preventDefault();

            const token = document.querySelector('input[name="_token"]').value;
            const idJadwal = document.getElementById('select-dokter').value;
            const tanggalDaftar = document.getElementById('select-date').value;
            const keluhanVal = document.getElementById('keluhan').value;

            if (!idJadwal || !tanggalDaftar || !keluhanVal) {
                alert('Harap isi semua input form!');
                return;
            }

            // Send AJAX POST
            fetch('{{ route('pasien.pendaftaran.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    id_jadwal: idJadwal,
                    tanggal_daftar: tanggalDaftar,
                    keluhan: keluhanVal
                })
            })
            .then(res => res.json())
            .then(resData => {
                if (resData.success) {
                    // Populate success card details
                    document.getElementById('success-queue-number').innerText = resData.nomor_antrean;
                    document.getElementById('success-poli').innerText = resData.poli;
                    document.getElementById('success-dokter').innerText = resData.dokter;
                    document.getElementById('success-tanggal').innerText = resData.tanggal;
                    document.getElementById('success-jam').innerText = resData.jam;

                    // Dynamically prepend new item to Riwayat list container
                    prependRiwayatItem(resData);

                    // Show success card, hide form
                    document.getElementById('antrean-form-wrapper').classList.add('hidden');
                    document.getElementById('antrean-success-wrapper').classList.remove('hidden');
                } else {
                    alert('Terjadi kesalahan saat menyimpan pendaftaran.');
                }
            })
            .catch(err => {
                console.error('Error submitting pendaftaran:', err);
                alert('Gagal mengirim pendaftaran ke server.');
            });
        }

        // Prepend new queue registration item to Riwayat list dynamically
        function prependRiwayatItem(data) {
            const listContainer = document.getElementById('riwayat-list-container');
            if (!listContainer) return;
            
            // Remove empty placeholder if any
            const emptyPlaceholder = listContainer.querySelector('.text-center');
            if (emptyPlaceholder) {
                emptyPlaceholder.remove();
            }

            const item = document.createElement('div');
            item.className = 'bg-white border border-teal-500 rounded-lg p-4 shadow-sm space-y-2';
            
            // Format current date
            const today = new Date();
            const dd = String(today.getDate()).padStart(2, '0');
            const mm = String(today.getMonth() + 1).padStart(2, '0');
            const yyyy = today.getFullYear();
            const todayStr = `${dd}-${mm}-${yyyy}`;

            item.innerHTML = `
                <div class="flex justify-between items-center pb-2 border-b border-gray-100">
                    <span class="text-xs font-extrabold text-[#005b66]">
                        Kunjungan Mendatang (Tiket #${data.id_pendaftaran})
                    </span>
                    <span class="text-[10px] text-gray-450 font-bold">${todayStr}</span>
                </div>
                <div class="text-xs text-gray-600 space-y-1">
                    <p><span class="font-medium text-gray-400">Poliklinik:</span> <span class="font-bold text-gray-800">${data.poli}</span></p>
                    <p><span class="font-medium text-gray-400">Dokter:</span> <span class="font-bold text-gray-800">${data.dokter}</span></p>
                    <p><span class="font-medium text-gray-400">Jam Pelayanan:</span> <span class="font-bold text-gray-800">${data.jam}</span></p>
                    <p class="flex items-center"><span class="font-medium text-gray-400">No. Antrean:</span> <span class="text-base font-extrabold text-[#005b66] ml-1.5">${data.nomor_antrean}</span></p>
                    <p class="pt-1">
                        <span class="font-medium text-gray-400 mr-1.5">Status:</span> 
                        <span class="bg-teal-100 text-teal-700 px-2.5 py-0.5 rounded text-[9px] font-bold inline-block">MENUNGGU</span>
                    </p>
                </div>
            `;
            // Insert at top of list
            listContainer.insertBefore(item, listContainer.firstChild);
        }

        // Action: Back to Home tab and reset pendaftaran form
        function backToHomeFromSuccess() {
            // Reset form
            document.getElementById('real-antrean-form').reset();
            document.getElementById('select-dokter').innerHTML = '<option value="">Pilih Jadwal Dokter</option>';
            document.getElementById('schedule-info-text').classList.add('hidden');

            // Switch to form layout again inside tab Antrean for future registrations
            document.getElementById('antrean-success-wrapper').classList.add('hidden');
            document.getElementById('antrean-form-wrapper').classList.remove('hidden');

            // Switch tab to Beranda
            switchTab('beranda');
        }
    </script>

</body>
</html>
