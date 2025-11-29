<?php

namespace App\Policies;

use App\Models\Pengaduan;
use App\Models\User;

class PengaduanPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_pengaduan');
    }

    public function view(User $user, Pengaduan $pengaduan): bool
    {
        return $user->hasPermissionTo('view_pengaduan');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_pengaduan');
    }

    public function update(User $user, Pengaduan $pengaduan): bool
    {
        if ($user->hasRole('user')) {
            return $pengaduan->user_id === $user->id;
        }

        return $user->hasPermissionTo('edit_pengaduan');
    }

    public function delete(User $user, Pengaduan $pengaduan): bool
    {
        if ($user->hasRole('user')) {
            return $pengaduan->user_id === $user->id;
        }

        return $user->hasPermissionTo('delete_pengaduan');
    }

    public function restore(User $user, Pengaduan $pengaduan): bool
    {
        return $user->hasPermissionTo('delete_pengaduan');
    }

    public function forceDelete(User $user, Pengaduan $pengaduan): bool
    {
        return $user->hasPermissionTo('delete_pengaduan');
    }

    public function verify(User $user): bool
    {
        return $user->hasPermissionTo('verify_pengaduan');
    }

    public function respond(User $user): bool
    {
        return $user->hasPermissionTo('respond_pengaduan');
    }
}
