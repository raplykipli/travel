@extends('layouts.app')

@section('title', 'Pemesanan Management')
@section('subtitle', 'Manage your bookings')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Pemesanan Management</h1>
            <div class="flex gap-2 items-center">
                <a href="{{ route('pemesanans.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md">Create
                    Pemesanan</a>
                <button type="button" onclick="salin()" class="bg-green-500 text-white px-4 py-2 rounded-md">
                    Salin Link Custommer
                </button>
            </div>

        </div>

        <div class="mb-4">
            <form action="{{ route('pemesanans.index') }}" method="GET">
                <div class="flex">
                    <input type="text" name="search" placeholder="Search Pemesanan..." value="{{ $search ?? '' }}"
                        class="w-full px-2 py-2 border-gray-300 rounded-md shadow-sm">
                    <button type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md">Search</button>
                </div>
            </form>
        </div>

        <div id="alertBox"
            class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4 text-center"
            role="alert">
            <span id="info" class="mx-auto"></span>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="w-full">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left">Kode Pemesanan</th>
                        <th class="px-6 py-3 text-left">Paket Tour</th>
                        <th class="px-6 py-3 text-left">Nama Pemesan</th>
                        <th class="px-6 py-3 text-left">Nomor Kursi</th>
                        <th class="px-6 py-3 text-left">Total Harga</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Status Pembayaran</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemesanans as $pemesanan)
                        <tr class="border-b">
                            <td class="px-6 py-4">{{ $pemesanan->kode_pemesanan }}</td>
                            <td class="px-6 py-4">{{ $pemesanan->package->nama_paket }}</td>
                            <td class="px-6 py-4">{{ $pemesanan->nama_pemesan }}</td>
                            <td class="px-6 py-4 font-bold">{{ $pemesanan->nomor_kursi ?? '-' }}</td>
                            <td class="px-6 py-4">{{ 'Rp ' . number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                @if ($pemesanan->status == 'dikonfirmasi')
                                    <span class="px-2 py-1 bg-green-500/80 text-white rounded-md">{{ $pemesanan->status }}</span>
                                @elseif ($pemesanan->status == 'menunggu')
                                    <span class="px-2 py-1 bg-yellow-500/80 text-white rounded-md">{{ $pemesanan->status }}</span>
                                @elseif ($pemesanan->status == 'selesai')
                                    <span class="px-2 py-1 bg-blue-500/80 text-white rounded-md">{{ $pemesanan->status }}</span>
                                @else
                                    <span class="px-2 py-1 bg-red-500/80 text-white rounded-md">{{ $pemesanan->status }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($pemesanan->status_pembayaran == 'lunas')
                                    <span
                                        class="px-2 py-1 bg-green-500/80 text-white rounded-md">{{ $pemesanan->status_pembayaran }}</span>
                                @elseif ($pemesanan->status_pembayaran == 'peding')
                                    <span
                                        class="px-2 py-1 bg-yellow-500/80 text-white rounded-md">{{ $pemesanan->status_pembayaran }}</span>
                                @else
                                    <span
                                        class="px-2 py-1 bg-red-500/80 text-white rounded-md">{{ $pemesanan->status_pembayaran }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 flex gap-4">
                                <a href="{{ route('pemesanans.edit', $pemesanan->id) }}"
                                    class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('pemesanans.destroy', $pemesanan->id) }}" method="POST"
                                    class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $pemesanans->appends(['search' => $search ?? ''])->links() }}
        </div>
    </div>
    <script>
        function salin() {
            navigator.clipboard.writeText("http://127.0.0.1:8000/form-pemesanan")
                .then(() => {
                    const alertBox = document.getElementById("alertBox");
                    const info = document.getElementById("info");

                    info.innerText = "Link Tersalin";
                    alertBox.classList.remove("hidden");

                    setTimeout(() => {
                        alertBox.classList.add("hidden");
                    }, 3000);
                });
        }
    </script>

@endsection