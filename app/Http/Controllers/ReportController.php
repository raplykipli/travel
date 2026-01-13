<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        $pemesanans = Pemesanan::with('package')->get();
        
        return view('reports.index', compact('pemesanans'));
    }

    public function exportPdf()
    {
        $pemesanans = Pemesanan::with('package')->get();
        $pdf = Pdf::loadView('reports.pdf', compact('pemesanans'));
        return $pdf->stream('laporan_pemesanan.pdf');
    }
}
