<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $fillable = [
        'plat_nomor',
        'jumlah_kursi',
        'jenis_bus',
        'image'
    ];

    public function paketTours()
    {
        return $this->hasMany(Package::class);
    }
}
