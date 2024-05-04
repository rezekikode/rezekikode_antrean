<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemetaanAntrean extends Model
{
    use HasFactory;

    public function lokasi()
    {
        return $this->belongsTo(Lokasi::class);
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

    public function loket()
    {
        return $this->belongsTo(Loket::class);
    }
}
