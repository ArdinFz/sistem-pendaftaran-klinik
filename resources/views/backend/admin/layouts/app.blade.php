<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Sistem Informasi Klinik')</title>
    <!-- Tailwind CSS & Google Fonts -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Top Navbar -->
    @include('backend.admin.layouts.navbar')

    <!-- Main Content Wrapper -->
    <div class="flex flex-1">
        
        <!-- Sidebar Menu Kiri -->
        @if(Auth::guard('admin')->check())
            @include('backend.admin.layouts.sidebar')
        @elseif(Auth::guard('pegawai')->check())
            @include('backend.pegawai.layouts.sidebar')
        @endif

        <!-- Content Area -->
        <main class="flex-1 p-6 bg-gray-100 overflow-y-auto">
            @yield('content')
        </main>
        
    </div>

    @stack('scripts')
</body>
</html>