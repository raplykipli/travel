<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $pemesanans = Pemesanan::with('package')->when($search, function ($query, $search) {
            return $query->where('nama_pemesan', 'like', "%{$search}%")
                ->orWhere('no_hp', 'like', "%{$search}%")
                ->orWhere('kode_pemesanan', 'like', "%{$search}%");
        })->paginate(10);
        return view('pemesanans.index', compact('pemesanans'));
    }

    /**
     * Get booked seats for a specific package and schedule via AJAX.
     */
    public function getKursiTerpakai(Request $request)
    {
        $paket_tour_id = $request->paket_tour_id;
        $jadwal = $request->jadwal;

        if (!$paket_tour_id || !$jadwal) {
            return response()->json([]);
        }

        $kursiTerpakai = Pemesanan::where('paket_tour_id', $paket_tour_id)
            ->where('jadwal', $jadwal)
            ->whereIn('status', ['menunggu', 'dikonfirmasi', 'selesai']) // Status yang menandakan kursi sudah dipesan/bayar
            ->pluck('nomor_kursi')
            ->filter()
            ->values()
            ->toArray();

        return response()->json($kursiTerpakai);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $packages = Package::with('bus')->get();

        // Generate kode_pemesanan
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

        return view('pemesanans.form', compact('packages', 'kode_pemesanan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, \App\Services\WhapiService $whapiService)
    {
        $request->validate([
            'paket_tour_id' => 'required|exists:packages,id',
            'jadwal' => 'required',
            'nama_pemesan' => 'required',
            'no_hp' => 'required',
            'nomor_kursi' => 'required|array|min:1',
            'nomor_kursi.*' => 'string',
            'status' => 'required|in:menunggu,dikonfirmasi,selesai,dibatalkan',
            'image_bukti' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'metode_pembayaran' => 'required',
            'status_pembayaran' => 'required|in:pending,lunas,batal',
        ]);

        $imagePath = null;
        if ($request->hasFile('image_bukti')) {
            $imagePath = $request->file('image_bukti')->store('bukti_pembayaran', 'public');
        }

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
                'status' => $request->status,
                'total_harga' => $package->harga,
                'image_bukti' => $imagePath,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status_pembayaran' => $request->status_pembayaran,
            ]);

            // Kirim WA Notifikasi
            $message = "Halo {$pemesanan->nama_pemesan},\n\n";
            $message .= "Kami telah membuat pesanan baru untuk Anda di Keystour Travel.\n";
            $message .= "Berikut detail pesanan:\n";
            $message .= "Kode Pesanan: *{$pemesanan->kode_pemesanan}*\n";
            $message .= "Paket: *{$package->nama_paket}*\n";
            $message .= "Jadwal: " . date('d M Y', strtotime($pemesanan->jadwal)) . "\n";
            $message .= "Nomor Kursi: *{$pemesanan->nomor_kursi}*\n";
            $message .= "Harga: Rp " . number_format($pemesanan->total_harga, 0, ',', '.') . "\n\n";
            $message .= "Status Pembayaran: *" . strtoupper($pemesanan->status_pembayaran) . "*\n\n";
            $message .= "Jika Anda membutuhkan bantuan, jangan ragu untuk membalas pesan ini.";

            $whapiService->sendMessage($pemesanan->no_hp, $message);
        }

        return redirect()->route('pemesanans.index')->with('success', 'Pemesanan created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemesanan $pemesanan)
    {
        $packages = Package::with('bus')->get();
        return view('pemesanans.form', compact('pemesanan', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemesanan $pemesanan, \App\Services\WhapiService $whapiService)
    {
        $request->validate([
            'kode_pemesanan' => 'required|unique:pemesanans,kode_pemesanan,' . $pemesanan->id,
            'nomor_kursi' => 'required|string',
            'paket_tour_id' => 'required|exists:packages,id',
            'jadwal' => 'required',
            'nama_pemesan' => 'required',
            'no_hp' => 'required',
            'status' => 'required|in:menunggu,dikonfirmasi,selesai,dibatalkan',
            'total_harga' => 'required|numeric',
            'image_bukti' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'metode_pembayaran' => 'required',
            'status_pembayaran' => 'required|in:pending,lunas,batal',
        ]);

        $oldStatus = $pemesanan->status;
        $oldPaymentStatus = $pemesanan->status_pembayaran;

        $imagePath = $pemesanan->image_bukti;
        if ($request->hasFile('image_bukti')) {
            if ($pemesanan->image_bukti) {
                Storage::disk('public')->delete($pemesanan->image_bukti);
            }
            $imagePath = $request->file('image_bukti')->store('bukti_pembayaran', 'public');
        }

        $package = Package::findOrFail($request->paket_tour_id);

        $pemesanan->update([
            'kode_pemesanan' => $request->kode_pemesanan,
            'nomor_kursi' => $request->nomor_kursi,
            'paket_tour_id' => $request->paket_tour_id,
            'jadwal' => $request->jadwal,
            'nama_pemesan' => $request->nama_pemesan,
            'no_hp' => $request->no_hp,
            'jumlah_peserta' => 1,
            'status' => $request->status,
            'total_harga' => $package->harga,
            'image_bukti' => $imagePath,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pembayaran' => $request->status_pembayaran,
        ]);

        // Send WA on update
        $pemesanan->load('package');

        $message = "Halo {$pemesanan->nama_pemesan},\n\n";
        $message .= "Terdapat pembaruan pada pesanan Anda.\n\n";
        $message .= "Kode Pesanan: *{$pemesanan->kode_pemesanan}*\n";
        $message .= "Nomor Kursi: *{$pemesanan->nomor_kursi}*\n";
        $message .= "Status Pesanan: *" . strtoupper($pemesanan->status) . "*\n";
        $message .= "Status Pembayaran: *" . strtoupper($pemesanan->status_pembayaran) . "*\n\n";

        if ($pemesanan->status == 'dikonfirmasi' && $pemesanan->status_pembayaran == 'lunas') {
            $message .= "Terima kasih! Pembayaran Anda telah kami terima dan pesanan telah dikonfirmasi. Sampai jumpa di hari keberangkatan.\n";
        } elseif ($pemesanan->status == 'dibatalkan') {
            $message .= "Mohon maaf, pesanan Anda telah dibatalkan. Jika Anda memiliki pertanyaan, silakan hubungi kami.\n";
        } else {
            $message .= "Detail paket: {$pemesanan->package->nama_paket}\n";
            $message .= "Jadwal: " . date('d M Y', strtotime($pemesanan->jadwal)) . "\n";
        }

        $message .= "\nSalam,\nKeystour Travel";

        $whapiService->sendMessage($pemesanan->no_hp, $message);

        return redirect()->route('pemesanans.index')->with('success', 'Pemesanan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pemesanan $pemesanan)
    {
        if ($pemesanan->image_bukti) {
            Storage::disk('public')->delete($pemesanan->image_bukti);
        }
        $pemesanan->delete();
        return redirect()->route('pemesanans.index')->with('success', 'Pemesanan deleted successfully.');
    }
}
