<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keystour Travel - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <div class="relative min-h-screen lg:flex">
        <!-- Sidebar -->
        <aside id="sidebar" class="w-64 bg-gradient-to-b from-blue-600 to-blue-800 text-white fixed inset-y-0 left-0 transform -translate-x-full lg:relative lg:translate-x-0 transition-transform duration-300 ease-in-out z-30 flex-shrink-0">
            <div class="p-6">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-plane-departure text-2xl"></i>
                    <h1 class="text-2xl font-bold">Keystour</h1>
                </div>
            </div>
            
            <nav class="mt-6">
                <a href="#" class="flex items-center px-6 py-3 bg-blue-700 border-l-4 border-white">
                    <i class="fas fa-home w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 hover:bg-blue-700 transition">
                    <i class="fas fa-user w-5"></i>
                    <span class="ml-3">Users</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 hover:bg-blue-700 transition">
                    <i class="fas fa-bus w-5"></i>
                    <span class="ml-3">Bus</span>
                </a>    
                <a href="#" class="flex items-center px-6 py-3 hover:bg-blue-700 transition">
                    <i class="fas fa-map-marked-alt w-5"></i>
                    <span class="ml-3">Paket Tour</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 hover:bg-blue-700 transition">
                    <i class="fas fa-calendar-check w-5"></i>
                    <span class="ml-3">Pemesanan</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 hover:bg-blue-700 transition">
                    <i class="fas fa-money-bill-wave w-5"></i>
                    <span class="ml-3">Transaksi</span>
                </a>
                <a href="#" class="flex items-center px-6 py-3 hover:bg-blue-700 transition">
                    <i class="fas fa-chart-line w-5"></i>
                    <span class="ml-3">Laporan</span>
                </a>
            </nav>
        </aside>

        <!-- Overlay -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-20 hidden lg:hidden"></div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-8 py-4">
                    <div class="flex items-center space-x-4">
                        <button id="sidebar-toggle" class="lg:hidden text-gray-600 hover:text-gray-800 focus:outline-none">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <div>
                            <h2 class="text-2xl font-semibold text-gray-800">Dashboard</h2>
                            <p class="text-sm text-gray-600">Selamat datang kembali, Admin</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <button class="relative p-2 text-gray-600 hover:bg-gray-100 rounded-full">
                            <i class="fas fa-bell text-xl"></i>
                            <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>
                        <div class="flex items-center space-x-3">
                            <img src="https://ui-avatars.com/api/?name=Admin+User&background=3b82f6&color=fff" 
                                 class="w-10 h-10 rounded-full" alt="Admin">
                            <div>
                                <p class="text-sm font-medium text-gray-700">Admin User</p>
                                <p class="text-xs text-gray-500">Administrator</p>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Content -->
            <main class="flex-1 overflow-y-auto p-8">
                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Total Booking</p>
                                <p class="text-3xl font-bold text-gray-800">1,247</p>
                                <p class="text-sm text-green-600 mt-2">
                                    <i class="fas fa-arrow-up"></i> 12% dari bulan lalu
                                </p>
                            </div>
                            <div class="bg-blue-100 p-4 rounded-full">
                                <i class="fas fa-calendar-check text-2xl text-blue-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Pendapatan</p>
                                <p class="text-3xl font-bold text-gray-800">Rp 842M</p>
                                <p class="text-sm text-green-600 mt-2">
                                    <i class="fas fa-arrow-up"></i> 8% dari bulan lalu
                                </p>
                            </div>
                            <div class="bg-green-100 p-4 rounded-full">
                                <i class="fas fa-money-bill-wave text-2xl text-green-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Tour Aktif</p>
                                <p class="text-3xl font-bold text-gray-800">34</p>
                                <p class="text-sm text-green-600 mt-2">
                                    <i class="fas fa-arrow-up"></i> 3 tour baru
                                </p>
                            </div>
                            <div class="bg-purple-100 p-4 rounded-full">
                                <i class="fas fa-map-marked-alt text-2xl text-purple-600"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Total Pelanggan</p>
                                <p class="text-3xl font-bold text-gray-800">5,892</p>
                                <p class="text-sm text-green-600 mt-2">
                                    <i class="fas fa-arrow-up"></i> 24% dari bulan lalu
                                </p>
                            </div>
                            <div class="bg-orange-100 p-4 rounded-full">
                                <i class="fas fa-users text-2xl text-orange-600"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts and Tables Row -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
                    <!-- Booking Terbaru -->
                    <div class="lg:col-span-2 bg-white rounded-lg shadow">
                        <div class="p-6 border-b">
                            <h3 class="text-lg font-semibold text-gray-800">Booking Terbaru</h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pelanggan</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Paket Tour</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-900">BK001</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">Ahmad Rizki</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">Bali Paradise</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">15 Jan 2026</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-800">Confirmed</span>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-900">BK002</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">Siti Nurhaliza</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">Lombok Explorer</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">16 Jan 2026</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-900">BK003</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">Budi Santoso</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">Jakarta City Tour</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">17 Jan 2026</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-800">Confirmed</span>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-900">BK004</td>
                                        <td class="px-6 py-4 text-sm text-gray-900">Dewi Lestari</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">Yogyakarta Heritage</td>
                                        <td class="px-6 py-4 text-sm text-gray-600">18 Jan 2026</td>
                                        <td class="px-6 py-4">
                                            <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-800">Cancelled</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Tour Populer -->
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-6 border-b">
                            <h3 class="text-lg font-semibold text-gray-800">Tour Populer</h3>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=100&h=100&fit=crop" 
                                         class="w-12 h-12 rounded-lg object-cover" alt="Bali">
                                    <div>
                                        <p class="font-medium text-gray-800">Bali Paradise</p>
                                        <p class="text-sm text-gray-500">342 booking</p>
                                    </div>
                                </div>
                                <i class="fas fa-fire text-orange-500"></i>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <img src="https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=100&h=100&fit=crop" 
                                         class="w-12 h-12 rounded-lg object-cover" alt="Lombok">
                                    <div>
                                        <p class="font-medium text-gray-800">Lombok Explorer</p>
                                        <p class="text-sm text-gray-500">289 booking</p>
                                    </div>
                                </div>
                                <i class="fas fa-fire text-orange-500"></i>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <img src="https://images.unsplash.com/photo-1588668214407-6ea9a6d8c272?w=100&h=100&fit=crop" 
                                         class="w-12 h-12 rounded-lg object-cover" alt="Yogyakarta">
                                    <div>
                                        <p class="font-medium text-gray-800">Yogyakarta Heritage</p>
                                        <p class="text-sm text-gray-500">256 booking</p>
                                    </div>
                                </div>
                                <i class="fas fa-star text-yellow-500"></i>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <img src="https://images.unsplash.com/photo-1555400681-5b55053ed5e5?w=100&h=100&fit=crop" 
                                         class="w-12 h-12 rounded-lg object-cover" alt="Bromo">
                                    <div>
                                        <p class="font-medium text-gray-800">Bromo Adventure</p>
                                        <p class="text-sm text-gray-500">198 booking</p>
                                    </div>
                                </div>
                                <i class="fas fa-star text-yellow-500"></i>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <img src="https://images.unsplash.com/photo-1604999333679-b86d54738315?w=100&h=100&fit=crop" 
                                         class="w-12 h-12 rounded-lg object-cover" alt="Raja Ampat">
                                    <div>
                                        <p class="font-medium text-gray-800">Raja Ampat Diving</p>
                                        <p class="text-sm text-gray-500">167 booking</p>
                                    </div>
                                </div>
                                <i class="fas fa-trophy text-blue-500"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <button class="flex flex-col items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-blue-500 hover:bg-blue-50 transition">
                            <i class="fas fa-plus-circle text-3xl text-blue-600 mb-2"></i>
                            <span class="text-sm font-medium text-gray-700">Tambah Tour Baru</span>
                        </button>
                        <button class="flex flex-col items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-green-500 hover:bg-green-50 transition">
                            <i class="fas fa-calendar-plus text-3xl text-green-600 mb-2"></i>
                            <span class="text-sm font-medium text-gray-700">Buat Booking</span>
                        </button>
                        <button class="flex flex-col items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition">
                            <i class="fas fa-user-plus text-3xl text-purple-600 mb-2"></i>
                            <span class="text-sm font-medium text-gray-700">Tambah Pelanggan</span>
                        </button>
                        <button class="flex flex-col items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-orange-500 hover:bg-orange-50 transition">
                            <i class="fas fa-file-invoice text-3xl text-orange-600 mb-2"></i>
                            <span class="text-sm font-medium text-gray-700">Lihat Laporan</span>
                        </button>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const sidebarOverlay = document.getElementById('sidebar-overlay');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', () => {
                    sidebar.classList.toggle('-translate-x-full');
                    sidebarOverlay.classList.toggle('hidden');
                });
            }

            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', () => {
                    sidebar.classList.toggle('-translate-x-full');
                    sidebarOverlay.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>