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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $packages = Package::all();

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
    public function store(Request $request)
    {
        $request->validate([
            'kode_pemesanan' => 'required|unique:pemesanans,kode_pemesanan',
            'paket_tour_id' => 'required|exists:packages,id',
            'jadwal' => 'required',
            'nama_pemesan' => 'required',
            'no_hp' => 'required',
            'jumlah_peserta' => 'required|integer|min:1',
            'status' => 'required|in:menunggu,dikonfirmasi,selesai,dibatalkan',
            'total_harga' => 'required|numeric',
            'image_bukti' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'metode_pembayaran' => 'required',
            'status_pembayaran' => 'required|in:pending,lunas,batal',
        ]);

        $imagePath = null;
        if ($request->hasFile('image_bukti')) {
            $imagePath = $request->file('image_bukti')->store('bukti_pembayaran', 'public');
        }

        Pemesanan::create(array_merge($request->all(), ['image_bukti' => $imagePath]));

        return redirect()->route('pemesanans.index')->with('success', 'Pemesanan created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pemesanan $pemesanan)
    {
        $packages = Package::all();
        return view('pemesanans.form', compact('pemesanan', 'packages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pemesanan $pemesanan)
    {
        $request->validate([
            'kode_pemesanan' => 'required|unique:pemesanans,kode_pemesanan,' . $pemesanan->id,
            'paket_tour_id' => 'required|exists:packages,id',
            'jadwal' => 'required',
            'nama_pemesan' => 'required',
            'no_hp' => 'required',
            'jumlah_peserta' => 'required|integer|min:1',
            'status' => 'required|in:menunggu,dikonfirmasi,selesai,dibatalkan',
            'total_harga' => 'required|numeric',
            'image_bukti' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'metode_pembayaran' => 'required',
            'status_pembayaran' => 'required|in:pending,lunas,batal',
        ]);

        $imagePath = $pemesanan->image_bukti;
        if ($request->hasFile('image_bukti')) {
            if ($pemesanan->image_bukti) {
                Storage::disk('public')->delete($pemesanan->image_bukti);
            }
            $imagePath = $request->file('image_bukti')->store('bukti_pembayaran', 'public');
        }

        $pemesanan->update(array_merge($request->all(), ['image_bukti' => $imagePath]));

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
