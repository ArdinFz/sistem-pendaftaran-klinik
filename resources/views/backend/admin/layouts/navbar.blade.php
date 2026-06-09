<header class="h-16 bg-[#005960] flex items-center justify-between px-6 z-10 shadow-md">
    <!-- Logo -->
    <div class="flex items-center space-x-3">
        <div class="w-10 h-10 flex items-center justify-center">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo Klinik" class="h-10 w-auto object-contain">
        </div>
    </div>
    <!-- Profile Icon & Dropdown -->
    <div class="relative flex items-center" id="profileDropdownWrapper">
        <button id="profileDropdownButton" class="focus:outline-none flex items-center">
            <img src="{{ asset('assets/images/profile.png') }}" alt="Avatar Profil" class="h-10 w-10 rounded-full object-cover cursor-pointer hover:opacity-90 transition-opacity">
        </button>
        
        <!-- Dropdown Menu -->
        <div id="profileDropdownMenu" class="hidden absolute right-0 top-12 w-40 bg-[#005960] border border-[#004247] rounded-lg shadow-xl overflow-hidden z-50 divide-y divide-[#004247]">
            <!-- Profil -->
            <a href="#" class="block px-6 py-3 text-white font-semibold text-base hover:bg-[#00474d] active:bg-[#003338] transition-colors text-left">
                Profil
            </a>
            <!-- Keluar (Logout) -->
            <a href="{{ route('logout') }}" class="block px-6 py-3 text-white font-semibold text-base hover:bg-[#00474d] active:bg-[#003338] transition-colors text-left">
                Keluar
            </a>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('profileDropdownButton');
        const menu = document.getElementById('profileDropdownMenu');
        
        if (btn && menu) {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                menu.classList.toggle('hidden');
            });
            
            document.addEventListener('click', function(e) {
                if (!menu.contains(e.target) && !btn.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        }
    });
</script>