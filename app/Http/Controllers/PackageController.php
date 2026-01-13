<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Bus;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $packages = Package::when($search, function ($query, $search) {
            return $query->where('nama_paket', 'like', "%{$search}%")
                         ->orWhere('destinasi', 'like', "%{$search}%")
                         ->orWhere('harga', 'like', "%{$search}%");
        })->paginate(10);
        return view('packages.index', compact('packages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $buses = Bus::all();
        return view('packages.form', compact('buses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'buses_id' => 'required|exists:buses,id',
            'nama_paket' => 'required',
            'destinasi' => 'required',
            'durasi' => 'required',
            'harga' => 'required|numeric',
            'max_peserta' => 'required|integer',
            'fasilitas' => 'required',
            'deskripsi' => 'required',
            'jadwal' => 'required|array',
            'jadwal.*.tanggal' => 'required|date',
            'jadwal.*.jam_berangkat' => 'required|date_format:H:i',
            'jadwal.*.jam_pulang' => 'required|date_format:H:i|after:jadwal.*.jam_berangkat',
            'jadwal.*.kuota' => 'required|integer|min:1',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Package::create($request->all());
        
        return redirect()->route('packages.index')->with('success', 'Package created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Package $package)
    {
        $buses = Bus::all();
        return view('packages.form', compact('package', 'buses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'buses_id' => 'required|exists:buses,id',
            'nama_paket' => 'required',
            'destinasi' => 'required',
            'durasi' => 'required',
            'harga' => 'required|numeric',
            'max_peserta' => 'required|integer',
            'fasilitas' => 'required',
            'deskripsi' => 'required',
            'jadwal' => 'required|array',
            'jadwal.*.tanggal' => 'required|date',
            'jadwal.*.jam_berangkat' => 'required|date_format:H:i',
            'jadwal.*.jam_pulang' => 'required|date_format:H:i|after:jadwal.*.jam_berangkat',
            'jadwal.*.kuota' => 'required|integer|min:1',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $package->update($request->all());

        return redirect()->route('packages.index')->with('success', 'Package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('packages.index')->with('success', 'Package deleted successfully.');
    }
}
