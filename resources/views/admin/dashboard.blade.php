@extends('layouts.app')

@section('breadcrumb', 'Dashboard')

@section('content')
    <div class="p-6">
        <!-- Welcome Header -->
        <div class="mb-8">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-amerta-primary mb-2">Dashboard Amerta</h1>
                    <p class="text-gray-600">Selamat datang kembali! Berikut adalah ringkasan aktivitas website budaya hari
                        ini.</p>
                </div>
                <div class="flex items-center space-x-3 mt-4 lg:mt-0">
                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                        <i class="fas fa-calendar-alt"></i>
                        <span>{{ date('d M Y') }}</span>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                        <i class="fas fa-clock"></i>
                        <span id="current-time">{{ date('H:i') }} WIB</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Key Metrics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Visitors -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-6 rounded-2xl text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -mr-8 -mt-8"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <i class="fas fa-users text-3xl text-blue-200"></i>
                        <span class="text-xs bg-white/20 px-2 py-1 rounded-full">+12.5%</span>
                    </div>
                    <p class="text-blue-100 text-sm mb-1">Total Pengunjung</p>
                    <p class="text-3xl font-bold">28,456</p>
                    <p class="text-xs text-blue-200 mt-2">Bulan ini</p>
                </div>
            </div>

            <!-- Page Views -->
            <div
                class="bg-gradient-to-br from-emerald-500 to-emerald-600 p-6 rounded-2xl text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -mr-8 -mt-8"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <i class="fas fa-eye text-3xl text-emerald-200"></i>
                        <span class="text-xs bg-white/20 px-2 py-1 rounded-full">+8.3%</span>
                    </div>
                    <p class="text-emerald-100 text-sm mb-1">Halaman Dilihat</p>
                    <p class="text-3xl font-bold">156,789</p>
                    <p class="text-xs text-emerald-200 mt-2">Bulan ini</p>
                </div>
            </div>

            <!-- Bounce Rate -->
            <div class="bg-gradient-to-br from-amber-500 to-amber-600 p-6 rounded-2xl text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -mr-8 -mt-8"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <i class="fas fa-chart-line text-3xl text-amber-200"></i>
                        <span class="text-xs bg-white/20 px-2 py-1 rounded-full">-3.2%</span>
                    </div>
                    <p class="text-amber-100 text-sm mb-1">Bounce Rate</p>
                    <p class="text-3xl font-bold">32.4%</p>
                    <p class="text-xs text-amber-200 mt-2">↓ Lebih baik</p>
                </div>
            </div>

            <!-- Average Session -->
            <div
                class="bg-gradient-to-br from-purple-500 to-purple-600 p-6 rounded-2xl text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -mr-8 -mt-8"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <i class="fas fa-stopwatch text-3xl text-purple-200"></i>
                        <span class="text-xs bg-white/20 px-2 py-1 rounded-full">+15.8%</span>
                    </div>
                    <p class="text-purple-100 text-sm mb-1">Rata-rata Sesi</p>
                    <p class="text-3xl font-bold">4m 32s</p>
                    <p class="text-xs text-purple-200 mt-2">Durasi kunjungan</p>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Visitor Analytics Chart -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">Analitik Pengunjung</h3>
                    <div class="flex items-center space-x-2">
                        <select
                            class="text-sm border border-gray-200 rounded-lg px-3 py-1 focus:ring-2 focus:ring-amerta-primary/20">
                            <option>7 Hari Terakhir</option>
                            <option>30 Hari Terakhir</option>
                            <option>3 Bulan Terakhir</option>
                        </select>
                    </div>
                </div>
                <div class="h-72">
                    <canvas id="visitorsChart"></canvas>
                </div>
            </div>

            <!-- Device Usage -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">Penggunaan Perangkat</h3>
                    <div class="text-sm text-gray-500">Bulan ini</div>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                            <span class="text-sm text-gray-700">Desktop</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-24 bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full" style="width: 58%"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-900">58%</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-emerald-500 rounded-full"></div>
                            <span class="text-sm text-gray-700">Mobile</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-24 bg-gray-200 rounded-full h-2">
                                <div class="bg-emerald-500 h-2 rounded-full" style="width: 35%"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-900">35%</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                            <span class="text-sm text-gray-700">Tablet</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <div class="w-24 bg-gray-200 rounded-full h-2">
                                <div class="bg-purple-500 h-2 rounded-full" style="width: 7%"></div>
                            </div>
                            <span class="text-sm font-medium text-gray-900">7%</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Device Stats -->
                <div class="mt-6 pt-6 border-t border-gray-100 grid grid-cols-3 gap-4 text-center">
                    <div>
                        <p class="text-2xl font-bold text-blue-600">16,490</p>
                        <p class="text-xs text-gray-500">Desktop</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-emerald-600">9,960</p>
                        <p class="text-xs text-gray-500">Mobile</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-purple-600">2,006</p>
                        <p class="text-xs text-gray-500">Tablet</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Performance & Regional Stats -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Top Content -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-6">Konten Terpopuler</h3>
                <div class="space-y-4">
                    <div class="flex items-start justify-between group hover:bg-gray-50 p-3 rounded-xl transition-colors">
                        <div class="flex-1">
                            <h4
                                class="text-sm font-medium text-gray-900 line-clamp-2 group-hover:text-amerta-primary transition-colors">
                                Sejarah Batik Nusantara
                            </h4>
                            <p class="text-xs text-gray-500 mt-1">/artikel/sejarah-batik</p>
                        </div>
                        <div class="text-right ml-3">
                            <p class="text-sm font-bold text-gray-900">2,847</p>
                            <p class="text-xs text-gray-500">views</p>
                        </div>
                    </div>

                    <div class="flex items-start justify-between group hover:bg-gray-50 p-3 rounded-xl transition-colors">
                        <div class="flex-1">
                            <h4
                                class="text-sm font-medium text-gray-900 line-clamp-2 group-hover:text-amerta-primary transition-colors">
                                Quiz Budaya Jawa
                            </h4>
                            <p class="text-xs text-gray-500 mt-1">/quiz/budaya-jawa</p>
                        </div>
                        <div class="text-right ml-3">
                            <p class="text-sm font-bold text-gray-900">1,923</p>
                            <p class="text-xs text-gray-500">views</p>
                        </div>
                    </div>

                    <div class="flex items-start justify-between group hover:bg-gray-50 p-3 rounded-xl transition-colors">
                        <div class="flex-1">
                            <h4
                                class="text-sm font-medium text-gray-900 line-clamp-2 group-hover:text-amerta-primary transition-colors">
                                Festival Budaya 2024
                            </h4>
                            <p class="text-xs text-gray-500 mt-1">/event/festival-2024</p>
                        </div>
                        <div class="text-right ml-3">
                            <p class="text-sm font-bold text-gray-900">1,756</p>
                            <p class="text-xs text-gray-500">views</p>
                        </div>
                    </div>

                    <div class="flex items-start justify-between group hover:bg-gray-50 p-3 rounded-xl transition-colors">
                        <div class="flex-1">
                            <h4
                                class="text-sm font-medium text-gray-900 line-clamp-2 group-hover:text-amerta-primary transition-colors">
                                Galeri Tari Tradisional
                            </h4>
                            <p class="text-xs text-gray-500 mt-1">/galeri/tari-tradisional</p>
                        </div>
                        <div class="text-right ml-3">
                            <p class="text-sm font-bold text-gray-900">1,542</p>
                            <p class="text-xs text-gray-500">views</p>
                        </div>
                    </div>

                    <div class="flex items-start justify-between group hover:bg-gray-50 p-3 rounded-xl transition-colors">
                        <div class="flex-1">
                            <h4
                                class="text-sm font-medium text-gray-900 line-clamp-2 group-hover:text-amerta-primary transition-colors">
                                Resep Gudeg Yogya
                            </h4>
                            <p class="text-xs text-gray-500 mt-1">/kuliner/gudeg-yogya</p>
                        </div>
                        <div class="text-right ml-3">
                            <p class="text-sm font-bold text-gray-900">1,389</p>
                            <p class="text-xs text-gray-500">views</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Regional Visitors -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-6">Pengunjung Regional</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-8 h-8 bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg flex items-center justify-center">
                                <span class="text-white text-xs font-bold">JK</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Jakarta</p>
                                <p class="text-xs text-gray-500">DKI Jakarta</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-gray-900">8,456</p>
                            <p class="text-xs text-gray-500">29.7%</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-8 h-8 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center">
                                <span class="text-white text-xs font-bold">JB</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Bandung</p>
                                <p class="text-xs text-gray-500">Jawa Barat</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-gray-900">5,234</p>
                            <p class="text-xs text-gray-500">18.4%</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-8 h-8 bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg flex items-center justify-center">
                                <span class="text-white text-xs font-bold">SB</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Surabaya</p>
                                <p class="text-xs text-gray-500">Jawa Timur</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-gray-900">4,123</p>
                            <p class="text-xs text-gray-500">14.5%</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-8 h-8 bg-gradient-to-r from-amber-500 to-amber-600 rounded-lg flex items-center justify-center">
                                <span class="text-white text-xs font-bold">YK</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Yogyakarta</p>
                                <p class="text-xs text-gray-500">DIY</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-gray-900">3,567</p>
                            <p class="text-xs text-gray-500">12.5%</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-8 h-8 bg-gradient-to-r from-pink-500 to-pink-600 rounded-lg flex items-center justify-center">
                                <span class="text-white text-xs font-bold">DPS</span>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Denpasar</p>
                                <p class="text-xs text-gray-500">Bali</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-gray-900">2,876</p>
                            <p class="text-xs text-gray-500">10.1%</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div
                                class="w-8 h-8 bg-gradient-to-r from-gray-500 to-gray-600 rounded-lg flex items-center justify-center">
                                <i class="fas fa-ellipsis-h text-white text-xs"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Lainnya</p>
                                <p class="text-xs text-gray-500">Regional lain</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-bold text-gray-900">4,200</p>
                            <p class="text-xs text-gray-500">14.8%</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-2xl border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-6">Aksi Cepat</h3>
                <div class="space-y-3">
                    <a href="/admin/content"
                        class="flex items-center justify-between p-3 bg-gradient-to-r from-amerta-primary to-amerta-secondary text-white rounded-xl hover:shadow-lg transition-all duration-200 group">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-plus-circle text-xl"></i>
                            <span class="font-medium">Tambah Konten</span>
                        </div>
                        <i class="fas fa-chevron-right group-hover:translate-x-1 transition-transform"></i>
                    </a>

                    <a href="/admin/library"
                        class="flex items-center justify-between p-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl hover:shadow-lg transition-all duration-200 group">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-upload text-xl"></i>
                            <span class="font-medium">Upload Media</span>
                        </div>
                        <i class="fas fa-chevron-right group-hover:translate-x-1 transition-transform"></i>
                    </a>

                    <a href="/admin/inbox"
                        class="flex items-center justify-between p-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-xl hover:shadow-lg transition-all duration-200 group">
                        <div class="flex items-center space-x-3">
                            <div class="relative">
                                <i class="fas fa-envelope text-xl"></i>
                                <span
                                    class="absolute -top-2 -right-2 w-5 h-5 bg-red-500 rounded-full text-xs flex items-center justify-center">5</span>
                            </div>
                            <span class="font-medium">Pesan Baru</span>
                        </div>
                        <i class="fas fa-chevron-right group-hover:translate-x-1 transition-transform"></i>
                    </a>

                    <a href="/admin/gallery"
                        class="flex items-center justify-between p-3 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-xl hover:shadow-lg transition-all duration-200 group">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-images text-xl"></i>
                            <span class="font-medium">Kelola Galeri</span>
                        </div>
                        <i class="fas fa-chevron-right group-hover:translate-x-1 transition-transform"></i>
                    </a>

                    <button
                        class="flex items-center justify-between p-3 bg-gradient-to-r from-amber-500 to-amber-600 text-white rounded-xl hover:shadow-lg transition-all duration-200 group w-full">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-download text-xl"></i>
                            <span class="font-medium">Export Data</span>
                        </div>
                        <i class="fas fa-chevron-right group-hover:translate-x-1 transition-transform"></i>
                    </button>
                </div>

                <!-- System Status -->
                <div class="mt-6 pt-6 border-t border-gray-100">
                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Status Sistem</h4>
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-600">Server</span>
                            <div class="flex items-center space-x-1">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                <span class="text-xs text-green-600">Online</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-600">Database</span>
                            <div class="flex items-center space-x-1">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                <span class="text-xs text-green-600">Optimal</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-xs text-gray-600">CDN</span>
                            <div class="flex items-center space-x-1">
                                <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                                <span class="text-xs text-yellow-600">Slow</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection
