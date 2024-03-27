<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AntreanPanggil extends Model
{
    use HasFactory;

    public function antrean(): BelongsTo
    {
        return $this->belongsTo(Antrean::class);
    }

    public function loket(): BelongsTo
    {
        return $this->belongsTo(Loket::class);
    }
}
