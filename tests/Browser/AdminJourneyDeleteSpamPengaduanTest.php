<?php

use App\Models\User;
use Database\Seeders\DatabaseSeeder;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

test('Admin journey verify and delete spam pengaduan', function () {
    $admin = User::where('email', 'admin@lapakaduan.go.id')->first();

    visit('/')
        ->assertSee('Platform pengaduan masyarakat')
        ->navigate('/main/login')
        ->type('[wire\:model="data.email"]', $admin->email)
        ->type('[wire\:model="data.password"]', 'password')
        ->submit()
        ->assertPathIs('/main')
        ->assertSee('Dashboard')
        ->navigate('/main/pengaduans')
        ->assertSee('Daftar Pengaduan')
        ->pressAndWaitFor('View', 1) // buka detail pengaduan (anggap admin menilai pengaduan tersebut spam)
        ->press('[title="Close"]') // tutup modal
        ->check('[aria-label="Select/deselect item 5 for bulk actions."]') // pilih pengaduan tersebut sebagai spam
        ->pressAndWaitFor('Bulk actions', 1) // buka dropdonw bulk actions
        ->pressAndWaitFor('Delete selected', 1) // pilih delete selected
        ->press('Delete') // konfirmasi delete
        ->assertSee('Deleted'); // verifikasi pengaduan berhasil dihapus
});