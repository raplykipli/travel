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
        $packages = Package::with('bus')->where('status', 'aktif')->get();

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

    public function store(Request $request, \App\Services\WhapiService $whapiService)
    {
        $request->validate([
            'paket_tour_id' => 'required|exists:packages,id',
            'jadwal' => 'required',
            'nama_pemesan' => 'required',
            'no_hp' => 'required',
            'nomor_kursi' => 'required|array|min:1',
            'nomor_kursi.*' => 'string',
        ]);

        $package = Package::findOrFail($request->paket_tour_id);

        $currentYear = date('Y');
        $lastPemesanan = Pemesanan::where('kode_pemesanan', 'like', "ps-{$currentYear}-%")
            ->orderBy('kode_pemesanan', 'desc')
            ->first();

        $lastNumber = 0;
        if ($lastPemesanan) {
            $lastNumber = (int) substr($lastPemesanan->kode_pemesanan, -4);
        }

        foreach ($request->nomor_kursi as $index => $kursi) {
            $newNumber = str_pad($lastNumber + 1 + $index, 4, '0', STR_PAD_LEFT);
            $kode_pemesanan = "ps-{$currentYear}-{$newNumber}";

            $pemesanan = Pemesanan::create([
                'kode_pemesanan' => $kode_pemesanan,
                'nomor_kursi' => $kursi,
                'paket_tour_id' => $request->paket_tour_id,
                'jadwal' => $request->jadwal,
                'nama_pemesan' => $request->nama_pemesan,
                'no_hp' => $request->no_hp,
                'jumlah_peserta' => 1,
                'status' => 'menunggu',
                'total_harga' => $package->harga,
                'status_pembayaran' => 'pending',
            ]);

            // Load package to get its name
            $pemesanan->load('package');

            // Send WhatsApp notification
            $message = "Halo {$pemesanan->nama_pemesan},\n\n";
            $message .= "Terima kasih telah melakukan pemesanan di Keystour Travel.\n";
            $message .= "Berikut detail pesanan Anda:\n";
            $message .= "Kode Pesanan: *{$pemesanan->kode_pemesanan}*\n";
            $message .= "Paket: *{$pemesanan->package->nama_paket}*\n";
            $message .= "Jadwal: " . date('d M Y', strtotime($pemesanan->jadwal)) . "\n";
            $message .= "Nomor Kursi: *{$pemesanan->nomor_kursi}*\n";
            $message .= "Total Harga: Rp " . number_format($pemesanan->total_harga, 0, ',', '.') . "\n\n";
            $message .= "Silakan melanjutkan ke proses pembayaran melalui link berikut:\n";
            $message .= route('form-user.payment', $pemesanan->id) . "\n\n";
            $message .= "Jika Anda membutuhkan bantuan, jangan ragu untuk membalas pesan ini.";

            $whapiService->sendMessage($pemesanan->no_hp, $message);
        }

        // Redirect to a thank you or success page where they are told to check WA
        return redirect()->route('form-user.thank-you')->with('success', 'Pesanan berhasil dibuat. Kami telah mengirimkan detail dan link pembayaran untuk masing-masing kursi melalui WhatsApp Anda.');
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
