@extends('layouts.app')

@section('title', 'Laporan Pemesanan')
@section('subtitle', 'View your booking reports')

@section('content')
    <div class="container mx-auto">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Laporan Pemesanan</h1>
            <a href="{{ route('reports.export.pdf') }}" target="_blank"
                class="bg-red-500 text-white px-4 py-2 rounded-md">Export to PDF</a>
        </div>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="w-full">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left">Kode Pemesanan</th>
                        <th class="px-6 py-3 text-left">Paket Tour</th>
                        <th class="px-6 py-3 text-left">Nama Pemesan</th>
                        <th class="px-6 py-3 text-left">Total Harga</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Status Pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemesanans as $pemesanan)
                        <tr class="border-b">
                            <td class="px-6 py-4">{{ $pemesanan->kode_pemesanan }}</td>
                            <td class="px-6 py-4">{{ $pemesanan->package->nama_paket }}</td>
                            <td class="px-6 py-4">{{ $pemesanan->nama_pemesan }}</td>
                            <td class="px-6 py-4">{{ 'Rp ' . number_format($pemesanan->total_harga, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                @if ($pemesanan->status == 'dikonfirmasi')
                                    <span
                                        class="px-2 py-1 bg-green-500/80 text-white rounded-md">{{ $pemesanan->status }}</span>
                                @elseif ($pemesanan->status == 'menunggu')
                                    <span
                                        class="px-2 py-1 bg-yellow-500/80 text-white rounded-md">{{ $pemesanan->status }}</span>
                                @elseif ($pemesanan->status == 'selesai')
                                    <span
                                        class="px-2 py-1 bg-red-500/80 text-white rounded-md">{{ $pemesanan->status }}</span>
                                @else
                                    <span
                                        class="px-2 py-1 bg-red-500/80 text-white rounded-md">{{ $pemesanan->status }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($pemesanan->status_pembayaran == 'lunas')
                                    <span
                                        class="px-2 py-1 bg-green-500/80 text-white rounded-md">{{ $pemesanan->status_pembayaran }}</span>
                                @elseif ($pemesanan->status_pembayaran == 'pending')
                                    <span
                                        class="px-2 py-1 bg-yellow-500/80 text-white rounded-md">{{ $pemesanan->status_pembayaran }}</span>
                                @else
                                    <span
                                        class="px-2 py-1 bg-red-500/80 text-white rounded-md">{{ $pemesanan->status_pembayaran }}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

