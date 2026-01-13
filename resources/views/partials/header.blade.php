<header class="bg-white shadow-sm">
    <div class="flex items-center justify-between px-8 py-4">
        <div class="flex items-center space-x-4">
            <button id="sidebar-toggle" class="lg:hidden text-gray-600 hover:text-gray-800 focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">@yield('title', 'Dashboard')</h2>
                <p class="text-sm text-gray-600">@yield('subtitle', 'Selamat datang kembali, Admin')</p>
            </div>
        </div>

        <div class="flex items-center space-x-4">
            <div class="flex items-center space-x-3">
                @php
                    $name = explode('@', auth()->user()->email)[0];
                @endphp
                <img src="https://ui-avatars.com/api/?name={{ urlencode($name) }}&background=3b82f6&color=fff"
                    class="w-10 h-10 rounded-full" alt="User">
                <div>
                    <p class="text-sm font-medium text-gray-700">{{ auth()->user()->email }}</p>
                    <p class="text-xs text-gray-500">{{ auth()->user()->role }}</p>
                </div>
            </div>
        </div>
    </div>
</header>
