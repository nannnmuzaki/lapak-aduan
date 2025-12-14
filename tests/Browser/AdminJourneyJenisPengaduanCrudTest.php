<?php

use App\Models\User;
use Database\Seeders\DatabaseSeeder;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

test('Admin journey create, view, and delete jenis pengaduan', function () {
    $admin = User::where('email', 'admin@lapakaduan.go.id')->first();

    visit('/')
        ->assertSee('Platform pengaduan masyarakat')
        ->navigate('/main/login')
        ->type('[wire\:model="data.email"]', $admin->email)
        ->type('[wire\:model="data.password"]', 'password')
        ->submit()
        ->assertPathIs('/main')
        ->assertSee('Dashboard')
        ->navigate('/main/jenis-pengaduans')
        ->assertSee('Daftar Jenis Pengaduan')
        ->pressAndWaitFor('Buat Jenis Pengaduan Baru', 1)
        ->assertSee('Buat Jenis Pengaduan Baru')
        ->type('[wire\:model="data.nama"]', 'Jenis Pengaduan Test')
        ->type('[wire\:model="data.deskripsi"]', 'Deskripsi untuk jenis pengaduan test.')
        ->pressAndWaitFor('[x-data="filamentFormButton"]', 2) // submit form create
        ->assertSee('Created') // notif berhasil buat jenis pengaduan
        ->assertSee('Jenis Pengaduan Test') // verifikasi jenis pengaduan muncul di daftar
        ->pressAndWaitFor('Jenis Pengaduan Test', 1) // buka form edit jenis pengaduan yang telah dibuat tadi
        ->assertSee('Edit Jenis Pengaduan')
        ->type('[wire\:model="data.nama"]', 'Jenis Pengaduan Updated')
        ->type('[wire\:model="data.deskripsi"]', 'Deskripsi untuk jenis pengaduan updated.')
        ->pressAndWaitFor('[x-data="filamentFormButton"]', 2) // submit form edit
        ->assertSee('Saved') // notif berhasil update jenis pengaduan
        ->assertSee('Jenis Pengaduan Updated') // verifikasi jenis pengaduan telah terupdate di daftar
        ->assertDontSee('Jenis Pengaduan Test') // verifikasi nama lama tidak muncul lagi
        ->check('[aria-label="Select/deselect item 5 for bulk actions."]') // pilih jenis pengaduan terbaru untuk dihapus
        ->pressAndWaitFor('Bulk actions', 1) // buka dropdonw bulk actions
        ->pressAndWaitFor('Delete selected', 1) // pilih delete selected
        ->press('Delete') // konfirmasi delete
        ->assertSee('Deleted'); // verifikasi pengaduan berhasil dihapus
});