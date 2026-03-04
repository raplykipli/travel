<aside
    class="w-64 bg-gradient-to-b from-red-600 to-red-800 text-white fixed inset-y-0 left-0 transform -translate-x-full lg:relative lg:translate-x-0 transition-transform duration-300 ease-in-out z-30 flex-shrink-0">
    <div class="p-6">
        <div class="flex items-center space-x-2">
            <i class="fas fa-plane-departure text-2xl"></i>
            <h1 class="text-2xl font-bold">Keystour</h1>
        </div>
    </div>

    <nav class="mt-6">
        <a href="{{ route('dashboard') }}"
            class="flex items-center px-6 py-3 {{ request()->routeIs('dashboard') ? 'bg-red-700 border-l-4 border-white' : '' }} hover:bg-red-700 transition">
            <i class="fas fa-home w-5"></i>
            <span class="ml-3">Dashboard</span>
        </a>
        <a href="{{ route('users.index') }}"
            class="flex items-center px-6 py-3 {{ request()->routeIs('users') ? 'bg-red-700 border-l-4 border-white' : '' }} hover:bg-red-700 transition">
            <i class="fas fa-user w-5"></i>
            <span class="ml-3">Users</span>
        </a>
        <a href="{{ route('bus.index') }}"
            class="flex items-center px-6 py-3 {{ request()->routeIs('bus') ? 'bg-red-700 border-l-4 border-white' : '' }} hover:bg-red-700 transition">
            <i class="fas fa-bus w-5"></i>
            <span class="ml-3">Bus</span>
        </a>
        <a href="{{ route('packages.index') }}"
            class="flex items-center px-6 py-3 {{ request()->routeIs('packages') ? 'bg-red-700 border-l-4 border-white' : '' }} hover:bg-red-700 transition">
            <i class="fas fa-map-marked-alt w-5"></i>
            <span class="ml-3">Paket Tour</span>
        </a>
        <a href="{{ route('pemesanans.index') }}"
            class="flex items-center px-6 py-3 {{ request()->routeIs('bookings') ? 'bg-red-700 border-l-4 border-white' : '' }} hover:bg-red-700 transition">
            <i class="fas fa-calendar-check w-5"></i>
            <span class="ml-3">Pemesanan</span>
        </a>
        <a href="{{ route('reports.index') }}"
            class="flex items-center px-6 py-3 {{ request()->routeIs('reports') ? 'bg-red-700 border-l-4 border-white' : '' }} hover:bg-red-700 transition">
            <i class="fas fa-chart-line w-5"></i>
            <span class="ml-3">Laporan</span>
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="flex items-center w-full px-6 py-3 hover:bg-red-700 transition focus:outline-none">
                <i class="fas fa-sign-out-alt w-5"></i>
                <span class="ml-3">Logout</span>
            </button>
        </form>
    </nav>
</aside>