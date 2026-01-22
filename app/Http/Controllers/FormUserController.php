<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormUserController extends Controller
{
    public function index()
    {
        $packages = Package::where('status', 'aktif')->get();

        $currentYear = date('Y');
        $lastPemesanan = Pemesanan::where('kode_pemesanan', 'like', "ps-{$currentYear}-%")
            ->orderBy('kode_pemesanan', 'desc')
            ->first();

        $lastNumber = 0;
        if ($lastPemesanan) {
            $lastNumber = (int) substr($lastPemesanan->kode_pemesanan, -4);
        }

        $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        $kode_pemesanan = "ps-{$currentYear}-{$newNumber}";

        return view('form_user.index', compact('packages', 'kode_pemesanan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_pemesanan' => 'required|unique:pemesanans,kode_pemesanan',
            'paket_tour_id' => 'required|exists:packages,id',
            'jadwal' => 'required',
            'nama_pemesan' => 'required',
            'no_hp' => 'required',
            'jumlah_peserta' => 'required|integer|min:1',
            'total_harga' => 'required|numeric',
        ]);

        $data = $request->all();
        $data['status'] = 'menunggu';
        $data['status_pembayaran'] = 'pending';

        $pemesanan = Pemesanan::create($data);

        return redirect()->route('form-user.payment', $pemesanan);
    }

    public function payment(Pemesanan $pemesanan)
    {
        return view('form_user.payment', compact('pemesanan'));
    }

    public function processPayment(Request $request, Pemesanan $pemesanan)
    {
        $request->validate([
            'metode_pembayaran' => 'required|in:transfer,cash',
            'image_bukti' => 'required_if:metode_pembayaran,transfer|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $pemesanan->metode_pembayaran = $request->metode_pembayaran;

        if ($request->metode_pembayaran == 'cash') {
            $pemesanan->status_pembayaran = 'lunas';
        } else {
            $pemesanan->status_pembayaran = 'pending';
        }

        if ($request->hasFile('image_bukti')) {
            $imagePath = $request->file('image_bukti')->store('bukti_pembayaran', 'public');
            $pemesanan->image_bukti = $imagePath;
        }

        $pemesanan->save();

        return redirect()->route('form-user.thank-you')->with('success', 'Pembayaran Anda sedang diproses.');
    }
}
