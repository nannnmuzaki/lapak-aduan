<?php

use App\Models\User;
use Database\Seeders\DatabaseSeeder;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

test('Admin journey create, view, and delete channel pengaduan', function () {
    $admin = User::where('email', 'admin@lapakaduan.go.id')->first();

    visit('/')
        ->assertSee('Platform pengaduan masyarakat')
        ->navigate('/main/login')
        ->type('[wire\:model="data.email"]', $admin->email)
        ->type('[wire\:model="data.password"]', 'password')
        ->submit()
        ->assertPathIs('/main')
        ->assertSee('Dashboard')
        ->navigate('/main/channel-pengaduans')
        ->assertSee('Daftar Channel Pengaduan')
        ->pressAndWaitFor('Buat Channel Pengaduan Baru', 1)
        ->assertSee('Buat Channel Pengaduan Baru')
        ->type('[wire\:model="data.nama"]', 'Channel Pengaduan Test')
        ->type('[wire\:model="data.deskripsi"]', 'Deskripsi untuk channel pengaduan test.')
        ->pressAndWaitFor('[x-data="filamentFormButton"]', 2) // submit form create
        // ->press('[wire\:click="gotoPage(2, \'page\')"]') // navigasi ke halaman 2 untuk melihat data yang baru dibuat
        ->assertSee('Created') // notif berhasil buat channel pengaduan
        ->assertSee('Channel Pengaduan Test') // verifikasi channel pengaduan muncul di daftar
        ->pressAndWaitFor('Channel Pengaduan Test', 1) // buka form edit channel pengaduan yang telah dibuat tadi
        ->assertSee('Edit Channel Pengaduan')
        ->type('[wire\:model="data.nama"]', 'Channel Pengaduan Updated')
        ->type('[wire\:model="data.deskripsi"]', 'Deskripsi untuk channel pengaduan updated.')
        ->pressAndWaitFor('[x-data="filamentFormButton"]', 2) // submit form edit
        ->assertSee('Saved') // notif berhasil update channel pengaduan
        // ->press('[wire\:click="gotoPage(2, \'page\')"]') // navigasi ke halaman 2 untuk melihat data yang baru diedit
        ->assertSee('Channel Pengaduan Updated') // verifikasi channel pengaduan telah terupdate di daftar
        ->assertDontSee('Channel Pengaduan Test') // verifikasi nama lama tidak muncul lagi
        ->check('[aria-label="Select/deselect item 10 for bulk actions."]') // pilih channel pengaduan terbaru untuk dihapus
        ->pressAndWaitFor('Bulk actions', 1) // buka dropdonw bulk actions
        ->pressAndWaitFor('Delete selected', 1) // pilih delete selected
        ->press('Delete') // konfirmasi delete
        ->assertSee('Deleted'); // verifikasi channel pengaduan berhasil dihapus
});