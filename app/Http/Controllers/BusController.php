<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $buses = Bus::when($search, function ($query, $search) {
            return $query->where('plat_nomor', 'like', "%{$search}%")
                         ->orWhere('jenis_bus', 'like', "%{$search}%");
        })->paginate(10);

        return view('bus.index', compact('buses', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('bus.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'plat_nomor' => 'required|unique:buses',
            'jumlah_kursi' => 'required|integer|min:1',
            'jenis_bus' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('bus_images', 'public');
        }

        Bus::create([
            'plat_nomor' => $request->plat_nomor,
            'jumlah_kursi' => $request->jumlah_kursi,
            'jenis_bus' => $request->jenis_bus,
            'image' => $imagePath,
        ]);

        return redirect()->route('bus.index')->with('success', 'Bus created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bus $bus)
    {
        return view('bus.form', compact('bus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bus $bus)
    {
        $request->validate([
            'plat_nomor' => 'required|unique:buses,plat_nomor,' . $bus->id,
            'jumlah_kursi' => 'required|integer|min:1',
            'jenis_bus' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($bus->image) {
                \Storage::disk('public')->delete($bus->image);
            }
            $imagePath = $request->file('image')->store('bus_images', 'public');
            $bus->image = $imagePath;
        }

        $bus->plat_nomor = $request->plat_nomor;
        $bus->jumlah_kursi = $request->jumlah_kursi;
        $bus->jenis_bus = $request->jenis_bus;
        $bus->save();

        return redirect()->route('bus.index')->with('success', 'Bus updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bus $bus)
    {
        if ($bus->image) {
            \Storage::disk('public')->delete($bus->image);
        }
        $bus->delete();
        return redirect()->route('bus.index')->with('success', 'Bus deleted successfully.');
    }
}
