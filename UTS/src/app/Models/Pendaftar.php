<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendaftar extends Model
{
    protected $fillable = [
        'user_id',
        'beasiswa_id',
        'nama_lengkap',
        'nim',
        'jurusan',
        'email',
        'no_hp',
        'berkas_khs',
        'berkas_ktp',
        'surat_rekomendasi',
        'status',
        'catatan',
    ];

    public function beasiswa(): BelongsTo
    {
        return $this->belongsTo(Beasiswa::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
