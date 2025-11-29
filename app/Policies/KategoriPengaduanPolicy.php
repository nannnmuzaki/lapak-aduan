<?php

namespace App\Policies;

use App\Models\KategoriPengaduan;
use App\Models\User;

class KategoriPengaduanPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_kategori_pengaduan');
    }

    public function view(User $user, KategoriPengaduan $kategoriPengaduan): bool
    {
        return $user->hasPermissionTo('view_kategori_pengaduan');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_kategori_pengaduan');
    }

    public function update(User $user, KategoriPengaduan $kategoriPengaduan): bool
    {
        return $user->hasPermissionTo('edit_kategori_pengaduan');
    }

    public function delete(User $user, KategoriPengaduan $kategoriPengaduan): bool
    {
        return $user->hasPermissionTo('delete_kategori_pengaduan');
    }

    public function restore(User $user, KategoriPengaduan $kategoriPengaduan): bool
    {
        return $user->hasPermissionTo('delete_kategori_pengaduan');
    }

    public function forceDelete(User $user, KategoriPengaduan $kategoriPengaduan): bool
    {
        return $user->hasPermissionTo('delete_kategori_pengaduan');
    }
}
