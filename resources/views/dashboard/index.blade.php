@extends('layouts.app')

@section('title', 'Dashboard')
@section('subtitle', 'Selamat datang kembali, Admin')

@section('content')
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Total Booking</p>
                    <p class="text-3xl font-bold text-gray-800">{{ number_format($totalBooking) }}</p>
                    <p class="text-sm {{ $persentaseBooking >= 0 ? 'text-green-600' : 'text-red-600' }} mt-2">
                        <i class="fas {{ $persentaseBooking >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i> {{ number_format(abs($persentaseBooking), 1) }}% dari bulan lalu
                    </p>
                </div>
                <div class="bg-red-100 p-4 rounded-full">
                    <i class="fas fa-calendar-check text-2xl text-red-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Pendapatan</p>
                    <p class="text-3xl font-bold text-gray-800">Rp {{ number_format($pendapatanTotal / 1000000, 1) }}Jt</p>
                    <p class="text-sm {{ $persentasePendapatan >= 0 ? 'text-green-600' : 'text-red-600' }} mt-2">
                        <i class="fas {{ $persentasePendapatan >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i> {{ number_format(abs($persentasePendapatan), 1) }}% dari bulan lalu
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
                    <p class="text-3xl font-bold text-gray-800">{{ $tourAktif }}</p>
                    <p class="text-sm text-green-600 mt-2">
                        <i class="fas fa-plus"></i> {{ $tourBaru }} tour baru bulan ini
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
                    <p class="text-3xl font-bold text-gray-800">{{ number_format($totalPelanggan) }}</p>
                    <p class="text-sm {{ $persentasePelanggan >= 0 ? 'text-green-600' : 'text-red-600' }} mt-2">
                        <i class="fas {{ $persentasePelanggan >= 0 ? 'fa-arrow-up' : 'fa-arrow-down' }}"></i> {{ number_format(abs($persentasePelanggan), 1) }}% dari bulan lalu
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
                        @forelse($bookingTerbaru as $booking)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $booking->kode_pemesanan }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $booking->nama_pemesan }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $booking->package->nama_paket ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $booking->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                @if($booking->status == 'dikonfirmasi')
                                <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-800">Confirmed</span>
                                @elseif($booking->status == 'menunggu')
                                <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Pending</span>
                                @elseif($booking->status == 'dibatalkan')
                                <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-800">Cancelled</span>
                                @else
                                <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-800">{{ ucfirst($booking->status) }}</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-sm text-center text-gray-500">Belum ada booking terbaru.</td>
                        </tr>
                        @endforelse
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
                @forelse($tourPopuler as $index => $tour)
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center text-xl font-bold text-gray-400">
                            {{ $index + 1 }}
                        </div>
                        <div>
                            <p class="font-medium text-gray-800">{{ $tour->nama_paket }}</p>
                            <p class="text-sm text-gray-500">{{ $tour->pemesanans_count }} booking</p>
                        </div>
                    </div>
                    @if($index == 0)
                    <i class="fas fa-fire text-orange-500"></i>
                    @elseif($index == 1)
                    <i class="fas fa-star text-yellow-500"></i>
                    @elseif($index == 2)
                    <i class="fas fa-medal text-gray-400"></i>
                    @endif
                </div>
                @empty
                <p class="text-sm text-gray-500">Belum ada data tour.</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('packages.create') }}"
                class="flex flex-col items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-red-500 hover:bg-red-50 transition">
                <i class="fas fa-plus-circle text-3xl text-red-600 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Tambah Tour Baru</span>
            </a>
            <a href="{{ route('pemesanans.create') }}"
                class="flex flex-col items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-green-500 hover:bg-green-50 transition">
                <i class="fas fa-calendar-plus text-3xl text-green-600 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Buat Booking</span>
            </a>
            <a href="{{ route('users.create') }}"
                class="flex flex-col items-center justify-center p-4 border-2 border-dashed border-gray-300 rounded-lg hover:border-purple-500 hover:bg-purple-50 transition">
                <i class="fas fa-user-plus text-3xl text-purple-600 mb-2"></i>
                <span class="text-sm font-medium text-gray-700">Tambah Akun Admin</span>
            </a>
        </div>
    </div>
@endsection
