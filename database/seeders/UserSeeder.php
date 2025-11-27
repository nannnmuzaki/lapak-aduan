<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@lapakaduan.go.id',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        // Create Staff Users
        $staff = User::create([
            'name' => 'Staff',
            'email' => 'staff@lapakaduan.go.id',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $staff->assignRole('staff');

        $staff1 = User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'siti.nurhaliza@lapakaduan.go.id',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $staff1->assignRole('staff');

        // Create Regular Users
        $users = [
            ['name' => 'Ahmad Wijaya', 'email' => 'ahmad.wijaya@gmail.com'],
            ['name' => 'Dewi Lestari', 'email' => 'dewi.lestari@gmail.com'],
            ['name' => 'Rudi Hartono', 'email' => 'rudi.hartono@yahoo.com'],
            ['name' => 'Sri Rahayu', 'email' => 'sri.rahayu@gmail.com'],
            ['name' => 'Agus Setiawan', 'email' => 'agus.setiawan@gmail.com'],
            ['name' => 'Linda Kusuma', 'email' => 'linda.kusuma@hotmail.com'],
            ['name' => 'Bambang Purnomo', 'email' => 'bambang.purnomo@gmail.com'],
            ['name' => 'Rina Marlina', 'email' => 'rina.marlina@gmail.com'],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]);
            $user->assignRole('user');
        }
    }
}
