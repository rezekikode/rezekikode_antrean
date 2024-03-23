<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Layanan extends Model
{
    use HasFactory;

    public function lokets(): BelongsToMany
    {
        return $this->belongsToMany(Loket::class)->withTimestamps();
    }
}
