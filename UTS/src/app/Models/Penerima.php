<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penerima extends Model
{
    protected $fillable = [
        'pendaftar_id',
        'jumlah_dana',
        'tanggal_pencairan',
        'status_pencairan',
    ];

    public function pendaftar(): BelongsTo
    {
        return $this->belongsTo(Pendaftar::class);
    }
}
