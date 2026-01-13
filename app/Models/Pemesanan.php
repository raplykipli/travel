<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    protected $fillable = [
        'kode_pemesanan',
        'paket_tour_id',
        'jadwal',
        'nama_pemesan',
        'no_hp',
        'jumlah_peserta',
        'status',
        'total_harga',
        'image_bukti',
        'metode_pembayaran',
        'status_pembayaran',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class, 'paket_tour_id');
    }
}
