<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Opd extends Model
{
    protected $fillable = [
        'nama',
        'kode',
        'deskripsi',
        'alamat',
        'telepon',
        'email',
    ];

    public function pengaduans(): HasMany
    {
        return $this->hasMany(Pengaduan::class);
    }
}
