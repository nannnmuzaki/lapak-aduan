<?php

use App\Models\User;
use Database\Seeders\DatabaseSeeder;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

test('Admin journey create, view, and delete kategori pengaduan', function () {
    $admin = User::where('email', 'admin@lapakaduan.go.id')->first();

    visit('/')
        ->assertSee('Platform pengaduan masyarakat')
        ->navigate('/main/login')
        ->type('[wire\:model="data.email"]', $admin->email)
        ->type('[wire\:model="data.password"]', 'password')
        ->submit()
        ->assertPathIs('/main')
        ->assertSee('Dashboard')
        ->navigate('/main/kategori-pengaduans')
        ->assertSee('Daftar Kategori Pengaduan')
        ->pressAndWaitFor('Buat Kategori Pengaduan Baru', 1)
        ->assertSee('Buat Kategori Pengaduan Baru')
        ->type('[wire\:model="data.nama"]', 'Kategori Pengaduan Test')
        ->type('[wire\:model="data.deskripsi"]', 'Deskripsi untuk kategori pengaduan test.')
        ->pressAndWaitFor('[x-data="filamentFormButton"]', 2) // submit form create
        // ->press('[wire\:click="gotoPage(2, \'page\')"]') // navigasi ke halaman 2 untuk melihat data yang baru dibuat
        ->assertSee('Created') // notif berhasil buat kategori pengaduan
        ->assertSee('Kategori Pengaduan Test') // verifikasi kategori pengaduan muncul di daftar
        ->pressAndWaitFor('Kategori Pengaduan Test', 1) // buka form edit kategori pengaduan yang telah dibuat tadi
        ->assertSee('Edit Kategori Pengaduan')
        ->type('[wire\:model="data.nama"]', 'Kategori Pengaduan Updated')
        ->type('[wire\:model="data.deskripsi"]', 'Deskripsi untuk kategori pengaduan updated.')
        ->pressAndWaitFor('[x-data="filamentFormButton"]', 2) // submit form edit
        ->assertSee('Saved') // notif berhasil update kategori pengaduan
        // ->press('[wire\:click="gotoPage(2, \'page\')"]') // navigasi ke halaman 2 untuk melihat data yang baru diedit
        ->assertSee('Kategori Pengaduan Updated') // verifikasi kategori pengaduan telah terupdate di daftar
        ->assertDontSee('Kategori Pengaduan Test') // verifikasi nama lama tidak muncul lagi
        ->check('[aria-label="Select/deselect item 12 for bulk actions."]') // pilih kategori pengaduan terbaru untuk dihapus
        ->pressAndWaitFor('Bulk actions', 1) // buka dropdonw bulk actions
        ->pressAndWaitFor('Delete selected', 1) // pilih delete selected
        ->press('Delete') // konfirmasi delete
        ->assertSee('Deleted'); // verifikasi pengaduan berhasil dihapus
});