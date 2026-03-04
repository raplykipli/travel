<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'buses_id',
        'nama_paket',
        'destinasi',
        'durasi',
        'harga',
        'max_peserta',
        'fasilitas',
        'deskripsi',
        'jadwal',
        'status',
    ];

    protected $casts = [
        'jadwal' => 'array',
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'buses_id');
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'paket_tour_id');
    }
}
