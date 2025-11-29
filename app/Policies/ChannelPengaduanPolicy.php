<?php

namespace App\Policies;

use App\Models\ChannelPengaduan;
use App\Models\User;

class ChannelPengaduanPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('view_channel_pengaduan');
    }

    public function view(User $user, ChannelPengaduan $channelPengaduan): bool
    {
        return $user->hasPermissionTo('view_channel_pengaduan');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('create_channel_pengaduan');
    }

    public function update(User $user, ChannelPengaduan $channelPengaduan): bool
    {
        return $user->hasPermissionTo('edit_channel_pengaduan');
    }

    public function delete(User $user, ChannelPengaduan $channelPengaduan): bool
    {
        return $user->hasPermissionTo('delete_channel_pengaduan');
    }

    public function restore(User $user, ChannelPengaduan $channelPengaduan): bool
    {
        return $user->hasPermissionTo('delete_channel_pengaduan');
    }

    public function forceDelete(User $user, ChannelPengaduan $channelPengaduan): bool
    {
        return $user->hasPermissionTo('delete_channel_pengaduan');
    }
}
