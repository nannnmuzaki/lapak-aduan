<?php

namespace App\Policies;

use App\Models\Opd;
use App\Models\User;

class OpdPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_opd');
    }

    public function view(User $user, Opd $opd): bool
    {
        return $user->hasPermissionTo('view_opd');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_opd');
    }

    public function update(User $user, Opd $opd): bool
    {
        return $user->hasPermissionTo('edit_opd');
    }

    public function delete(User $user, Opd $opd): bool
    {
        return $user->hasPermissionTo('delete_opd');
    }

    public function restore(User $user, Opd $opd): bool
    {
        return $user->hasPermissionTo('delete_opd');
    }

    public function forceDelete(User $user, Opd $opd): bool
    {
        return $user->hasPermissionTo('delete_opd');
    }
}
