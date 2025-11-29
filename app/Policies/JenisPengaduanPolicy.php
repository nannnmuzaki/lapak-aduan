<?php

namespace App\Policies;

use App\Models\JenisPengaduan;
use App\Models\User;

class JenisPengaduanPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_jenis_pengaduan');
    }

    public function view(User $user, JenisPengaduan $jenisPengaduan): bool
    {
        return $user->hasPermissionTo('view_jenis_pengaduan');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_jenis_pengaduan');
    }

    public function update(User $user, JenisPengaduan $jenisPengaduan): bool
    {
        return $user->hasPermissionTo('edit_jenis_pengaduan');
    }

    public function delete(User $user, JenisPengaduan $jenisPengaduan): bool
    {
        return $user->hasPermissionTo('delete_jenis_pengaduan');
    }

    public function restore(User $user, JenisPengaduan $jenisPengaduan): bool
    {
        return $user->hasPermissionTo('delete_jenis_pengaduan');
    }

    public function forceDelete(User $user, JenisPengaduan $jenisPengaduan): bool
    {
        return $user->hasPermissionTo('delete_jenis_pengaduan');
    }
}
