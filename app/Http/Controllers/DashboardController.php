<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Package;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $lastMonth = Carbon::now()->subMonth();

        // 1. Total Booking
        $totalBooking = Pemesanan::count();
        $bookingBulanLalu = Pemesanan::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)->count();
        $bookingBulanIni = Pemesanan::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)->count();
        
        $persentaseBooking = 0;
        if ($bookingBulanLalu > 0) {
            $persentaseBooking = (($bookingBulanIni - $bookingBulanLalu) / $bookingBulanLalu) * 100;
        } elseif ($bookingBulanIni > 0) {
            $persentaseBooking = 100;
        }

        // 2. Pendapatan
        $pendapatanTotal = Pemesanan::where('status_pembayaran', 'lunas')->sum('total_harga');
        $pendapatanBulanLalu = Pemesanan::where('status_pembayaran', 'lunas')
            ->whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)->sum('total_harga');
        $pendapatanBulanIni = Pemesanan::where('status_pembayaran', 'lunas')
            ->whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)->sum('total_harga');

        $persentasePendapatan = 0;
        if ($pendapatanBulanLalu > 0) {
            $persentasePendapatan = (($pendapatanBulanIni - $pendapatanBulanLalu) / $pendapatanBulanLalu) * 100;
        } elseif ($pendapatanBulanIni > 0) {
            $persentasePendapatan = 100;
        }

        // 3. Tour Aktif
        $tourAktif = Package::where('status', 'aktif')->count();
        $tourBaru = Package::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)->count();

        // 4. Total Pelanggan (berdasarkan no_hp unik)
        $totalPelanggan = Pemesanan::distinct('no_hp')->count('no_hp');
        $pelangganBulanLalu = Pemesanan::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)->distinct('no_hp')->count('no_hp');
        $pelangganBulanIni = Pemesanan::whereMonth('created_at', $now->month)
            ->whereYear('created_at', $now->year)->distinct('no_hp')->count('no_hp');

        $persentasePelanggan = 0;
        if ($pelangganBulanLalu > 0) {
            $persentasePelanggan = (($pelangganBulanIni - $pelangganBulanLalu) / $pelangganBulanLalu) * 100;
        } elseif ($pelangganBulanIni > 0) {
            $persentasePelanggan = 100;
        }

        // 5. Booking Terbaru
        $bookingTerbaru = Pemesanan::with('package')->latest()->take(5)->get();

        // 6. Tour Populer
        // Add a local scope or simple query for tour populer
        $tourPopuler = Package::withCount('pemesanans')
            ->orderBy('pemesanans_count', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalBooking', 'persentaseBooking',
            'pendapatanTotal', 'persentasePendapatan',
            'tourAktif', 'tourBaru',
            'totalPelanggan', 'persentasePelanggan',
            'bookingTerbaru',
            'tourPopuler'
        ));
    }
}
