<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'view_pengaduan',
            'create_pengaduan',
            'edit_pengaduan',
            'delete_pengaduan',
            'verify_pengaduan',
            'respond_pengaduan',
            
            'view_jenis_pengaduan',
            'create_jenis_pengaduan',
            'edit_jenis_pengaduan',
            'delete_jenis_pengaduan',
            
            'view_kategori_pengaduan',
            'create_kategori_pengaduan',
            'edit_kategori_pengaduan',
            'delete_kategori_pengaduan',
            
            'view_channel_pengaduan',
            'create_channel_pengaduan',
            'edit_channel_pengaduan',
            'delete_channel_pengaduan',
            
            'view_opd',
            'create_opd',
            'edit_opd',
            'delete_opd',
            
            'view_users',
            'create_users',
            'edit_users',
            'delete_users',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $adminRole = Role::create(['name' => 'admin']);
        $staffRole = Role::create(['name' => 'staff']);
        $userRole = Role::create(['name' => 'user']);

        // Assign all permissions to admin
        $adminRole->givePermissionTo(Permission::all());

        // Assign permissions to staff (can manage pengaduan and master data, but not users/roles)
        $staffRole->givePermissionTo([
            // Pengaduan permissions
            'view_pengaduan',
            'create_pengaduan',
            'edit_pengaduan',
            'delete_pengaduan',
            'verify_pengaduan',
            'respond_pengaduan',
            
            // Master data permissions
            'view_jenis_pengaduan',
            
            'view_kategori_pengaduan',
            
            'view_channel_pengaduan',
            
            'view_opd',
        ]);

        // Assign limited permissions to user
        $userRole->givePermissionTo([
            'view_pengaduan',
            'create_pengaduan',
            'edit_pengaduan',
        ]);
    }
}
