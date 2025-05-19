<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Beasiswa extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
        'kuota',
        'deadline',
        'persyaratan',
    ];

    public function pendaftars(): HasMany
    {
        return $this->hasMany(Pendaftar::class);
    }
}
