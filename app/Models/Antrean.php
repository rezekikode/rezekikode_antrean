<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Antrean extends Model
{
    use HasFactory;

    public function layanan(): BelongsTo
    {
        return $this->belongsTo(Layanan::class);
    }

    public function panggils(): HasMany
    {
        return $this->HasMany(AntreanPanggil::class);
    }
}
