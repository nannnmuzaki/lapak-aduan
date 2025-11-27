<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriPengaduan extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public function pengaduans(): HasMany
    {
        return $this->hasMany(Pengaduan::class);
    }
}
