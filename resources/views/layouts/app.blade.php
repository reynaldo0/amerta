<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - Amerta</title>
    <link rel="shortcut icon" href="{{ URL::asset('img/amerta_favicon.ico') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://kit.fontawesome.com/5cedab7152.js" crossorigin="anonymous"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'amerta-primary': '#8B4513',
                        'amerta-secondary': '#D2691E',
                        'amerta-accent': '#F4A460',
                        'amerta-dark': '#654321'
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }
        
        .cultural-pattern {
            background-image: 
                radial-gradient(circle at 25% 25%, rgba(139, 69, 19, 0.1) 2px, transparent 2px),
                radial-gradient(circle at 75% 75%, rgba(210, 105, 30, 0.1) 2px, transparent 2px);
            background-size: 20px 20px;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Top Navigation -->
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 shadow-sm">
        <div class="px-4 py-3 lg:px-6 lg:pl-4">
            <div class="flex items-center justify-between">
                <!-- Left Section -->
                <div class="flex items-center">
                    <!-- Mobile Hamburger -->
                    <button id="hamburger-btn" type="button"
                        class="inline-flex items-center p-2 text-gray-600 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-amerta-primary/20 transition-colors">
                        <span class="sr-only">Buka menu</span>
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                    
                    <!-- Logo & Brand -->
                    <a href="/admin" class="flex items-center ml-2 lg:ml-0">
                        <div class="w-10 h-10 bg-gradient-to-br from-amerta-primary to-amerta-secondary rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-dharmachakra text-white text-xl"></i>
                        </div>
                        <div class="hidden sm:block">
                            <h1 class="text-2xl font-bold text-amerta-primary">Amerta</h1>
                            <p class="text-xs text-gray-500 -mt-1">Admin Panel</p>
                        </div>
                    </a>
                </div>

                <!-- Right Section -->
                <div class="flex items-center space-x-3">
                    <!-- Notifications -->
                    <button class="p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors">
                        <i class="fas fa-bell text-lg"></i>
                    </button>
                    
                    <!-- User Profile -->
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-amerta-primary rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        <span class="hidden md:block text-sm font-medium text-gray-700">Admin</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <aside id="logo-sidebar"
        class="fixed top-0 left-0 z-40 w-72 h-screen pt-20 transition-transform -translate-x-full lg:translate-x-0 bg-white border-r border-gray-200 sidebar-transition"
        aria-label="Sidebar">
        
        <!-- Cultural Header Pattern -->
        <div class="cultural-pattern h-24 border-b border-gray-100 flex items-center justify-center">
            <div class="text-center">
                <h2 class="text-lg font-semibold text-amerta-primary">Panel Budaya</h2>
                <p class="text-xs text-gray-500">Kelola Konten Amerta</p>
            </div>
        </div>

        <div class="h-full px-4 py-6 overflow-y-auto bg-white">
            <ul class="space-y-3 font-medium">
                <!-- Dashboard -->
                <li>
                    <a href="/admin/dashboard"
                        class="flex items-center p-3 text-gray-700 rounded-xl hover:bg-amerta-primary/10 hover:text-amerta-primary transition-all duration-200 group">
                        <i class="fas fa-chart-pie text-lg w-5"></i>
                        <span class="ml-4">Dashboard</span>
                    </a>
                </li>
                
                <!-- Inbox -->
                <li>
                    <a href="/admin/inbox"
                        class="flex items-center p-3 text-gray-700 rounded-xl hover:bg-amerta-primary/10 hover:text-amerta-primary transition-all duration-200 group">
                        <i class="fas fa-inbox text-lg w-5"></i>
                        <span class="ml-4">Pesan Masuk</span>
                        <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-1">3</span>
                    </a>
                </li>

                <!-- Content Management -->
                <li class="pt-4">
                    <h3 class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Konten Budaya</h3>
                </li>
                
                <li>
                    <a href="/admin/activity"
                        class="flex items-center p-3 text-gray-700 rounded-xl hover:bg-amerta-primary/10 hover:text-amerta-primary transition-all duration-200 group">
                        <i class="fas fa-calendar-alt text-lg w-5"></i>
                        <span class="ml-4">Kegiatan</span>
                    </a>
                </li>
                
                <li>
                    <a href="/admin/services"
                        class="flex items-center p-3 text-gray-700 rounded-xl hover:bg-amerta-primary/10 hover:text-amerta-primary transition-all duration-200 group">
                        <i class="fas fa-hands-helping text-lg w-5"></i>
                        <span class="ml-4">Layanan</span>
                    </a>
                </li>
                
                <li>
                    <a href="/admin/gallery"
                        class="flex items-center p-3 text-gray-700 rounded-xl hover:bg-amerta-primary/10 hover:text-amerta-primary transition-all duration-200 group">
                        <i class="fas fa-images text-lg w-5"></i>
                        <span class="ml-4">Galeri Budaya</span>
                    </a>
                </li>

                <!-- Team & Settings -->
                <li class="pt-4">
                    <h3 class="px-3 text-xs font-semibold text-gray-400 uppercase tracking-wider">Pengaturan</h3>
                </li>
                
                <li>
                    <a href="/admin/team"
                        class="flex items-center p-3 text-gray-700 rounded-xl hover:bg-amerta-primary/10 hover:text-amerta-primary transition-all duration-200 group">
                        <i class="fas fa-users text-lg w-5"></i>
                        <span class="ml-4">Tim Amerta</span>
                    </a>
                </li>
                
                <li>
                    <a href="/admin/config"
                        class="flex items-center p-3 text-gray-700 rounded-xl hover:bg-amerta-primary/10 hover:text-amerta-primary transition-all duration-200 group">
                        <i class="fas fa-cog text-lg w-5"></i>
                        <span class="ml-4">Konfigurasi</span>
                    </a>
                </li>

                <!-- Logout -->
                <li class="pt-6">
                    <a href="/logout"
                        class="flex items-center p-3 text-red-600 rounded-xl hover:bg-red-50 transition-all duration-200 group">
                        <i class="fas fa-sign-out-alt text-lg w-5"></i>
                        <span class="ml-4">Keluar</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="p-6 lg:ml-72 mt-20">
        <!-- Breadcrumb -->
        <nav class="flex mb-6" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="/admin" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-amerta-primary">
                        <i class="fas fa-home mr-2"></i>
                        Admin
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="text-sm font-medium text-gray-500">@yield('breadcrumb', 'Dashboard')</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Content Area -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 min-h-[calc(100vh-12rem)]">
            @yield('content')
        </div>
    </div>

    <!-- Mobile Sidebar Overlay -->
    <div id="sidebar-overlay" class="fixed inset-0 z-20 bg-black bg-opacity-50 lg:hidden hidden transition-opacity duration-300"></div>

    <script>
        // Mobile sidebar toggle
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const sidebar = document.getElementById('logo-sidebar');
        const overlay = document.getElementById('sidebar-overlay');

        hamburgerBtn.addEventListener('click', function() {
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        });

        // Close sidebar when clicking overlay
        overlay.addEventListener('click', function() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        });

        // Close sidebar on window resize to large screen
        window.addEventListener('resize', function() {
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
            }
        });

        // Active menu highlighting
        const currentPath = window.location.pathname;
        const menuLinks = document.querySelectorAll('aside a[href]');
        
        menuLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.remove('text-gray-700', 'hover:bg-amerta-primary/10');
                link.classList.add('bg-amerta-primary', 'text-white');
            }
        });
    </script>
</body>

</html>