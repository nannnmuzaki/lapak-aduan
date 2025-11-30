<?php

use App\Models\User;
use Database\Seeders\DatabaseSeeder;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

test('test unauthenticated user access restriction (Auth Journey)', function () {
    visit('/')
        ->assertSee('Lapak Aduan Kabupaten Banyumas')
        ->assertDontSee('Pengaduan Saya') // Pengaduan saya tidak muncul apabila belum login
        ->navigate('/main') // coba akses panel admin
        ->assertPathIs('/main/login') // harusnya di-redirect ke halaman login
        ->assertSee('Sign in')
        ->navigate('/buat-pengaduan') // coba akses halaman buat pengaduan
        ->assertPathIs('/main/login') // harusnya di-redirect ke halaman login
        ->navigate('/pengaduan-saya') // coba akses halaman pengaduan saya
        ->assertPathIs('/main/login'); // harusnya di-redirect ke halaman login
});

test('test regular user authentication and access restriction (Auth Journey)', function () {
    $user = User::where('email', 'rina.marlina@gmail.com')->first();

    visit('/')
        ->assertSee('Lapak Aduan Kabupaten Banyumas')
        ->assertDontSee('Pengaduan Saya') // Pengaduan saya tidak muncul apabila belum login
        ->navigate('/main/login')
        ->assertSee('Sign in')
        ->type('[wire\:model="data.email"]', $user->email)
        ->type('[wire\:model="data.password"]', 'password')
        ->submit()
        ->assertPathIs('/')
        ->assertSee('Pengaduan Saya') // Pengaduan saya baru muncul setelah login
        ->navigate('/main') // coba akses panel admin
        ->assertPathIs('/') // harusnya di-redirect ke home
        ->press('[\\@click="open = !open"]') // tombol dropdown profile
        ->assertDontSee('Admin Panel') // tombol untuk masuk ke admin panel hanya muncul untuk role admin dan staff
        ->press('Keluar')
        ->assertPathIs('/')
        ->assertDontSee('Pengaduan Saya');
});

test('test admin user authentication and access to admin panel (Auth Journey)', function () {
    $admin = User::where('email', 'admin@lapakaduan.go.id')->first();

    visit('/')
        ->assertSee('Lapak Aduan Kabupaten Banyumas')
        ->assertDontSee('Pengaduan Saya') // Pengaduan saya tidak muncul apabila belum login
        ->navigate('/main/login')
        ->assertSee('Sign in')
        ->type('[wire\:model="data.email"]', $admin->email)
        ->type('[wire\:model="data.password"]', 'password')
        ->submit()
        ->assertPathIs('/main') // harusnya di-redirect ke panel admin
        ->assertSee('Dashboard')
        ->navigate('/')
        ->assertSee('Pengaduan Saya') // Pengaduan saya muncul setelah login
        ->press('[\\@click="open = !open"]') // tombol dropdown profile
        ->assertSee('Admin Panel') // tombol untuk masuk ke admin panel hanya muncul untuk role admin dan staff
        ->press('Keluar')
        ->assertPathIs('/')
        ->assertDontSee('Pengaduan Saya');
});

test('test staff user authentication and access to admin panel (Auth Journey)', function () {
    $staff = User::where('email', 'staff@lapakaduan.go.id')->first();

    visit('/')
        ->assertSee('Lapak Aduan Kabupaten Banyumas')
        ->assertDontSee('Pengaduan Saya') // Pengaduan saya tidak muncul apabila belum login
        ->navigate('/main/login')
        ->assertSee('Sign in')
        ->type('[wire\:model="data.email"]', $staff->email)
        ->type('[wire\:model="data.password"]', 'password')
        ->submit()
        ->assertPathIs('/main') // harusnya di-redirect ke panel admin
        ->assertSee('Dashboard')
        ->assertDontSee('User Management') // policy role staff tidak boleh mengakses dan mengelola user management
        ->navigate('/')
        ->assertSee('Pengaduan Saya') // Pengaduan saya muncul setelah login
        ->press('[\\@click="open = !open"]') // tombol dropdown profile
        ->assertSee('Admin Panel') // tombol untuk masuk ke admin panel hanya muncul untuk role admin dan staff
        ->press('Keluar')
        ->assertPathIs('/')
        ->assertDontSee('Pengaduan Saya');
});