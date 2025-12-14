<?php

use App\Models\User;
use Database\Seeders\DatabaseSeeder;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

test('Admin journey create, view, and delete OPD', function () {
    $admin = User::where('email', 'admin@lapakaduan.go.id')->first();

    visit('/')
        ->assertSee('Platform pengaduan masyarakat')
        ->navigate('/main/login')
        ->type('[wire\:model="data.email"]', $admin->email)
        ->type('[wire\:model="data.password"]', 'password')
        ->submit()
        ->assertPathIs('/main')
        ->assertSee('Dashboard')
        ->navigate('/main/opds')
        ->assertSee('Daftar OPD')
        ->pressAndWaitFor('Buat OPD Baru', 1)
        ->assertSee('Buat OPD Baru')
        ->type('[wire\:model="data.nama"]', 'OPD Test')
        ->type('[wire\:model="data.kode"]', 'TEST')
        ->type('[wire\:model="data.deskripsi"]', 'Deskripsi untuk OPD test.')
        ->type('[wire\:model="data.alamat"]', 'Alamat untuk OPD test.')
        ->type('[wire\:model="data.telepon"]', '081234567890')
        ->type('[wire\:model="data.email"]', 'test@opd.test')
        ->pressAndWaitFor('[x-data="filamentFormButton"]', 2) // submit form create
        // ->press('[wire\:click="gotoPage(2, \'page\')"]') // navigasi ke halaman 2 untuk melihat data yang baru dibuat
        ->assertSee('Created') // notif berhasil buat OPD
        ->assertSee('OPD Test') // verifikasi OPD muncul di daftar
        ->pressAndWaitFor('OPD Test', 1) // buka form edit OPD yang telah dibuat tadi
        ->assertSee('Edit OPD')
        ->type('[wire\:model="data.nama"]', 'OPD Updated')
        ->type('[wire\:model="data.deskripsi"]', 'Deskripsi untuk OPD updated.')
        ->type('[wire\:model="data.alamat"]', 'Alamat untuk OPD updated.')
        ->pressAndWaitFor('[x-data="filamentFormButton"]', 2) // submit form edit
        ->assertSee('Saved') // notif berhasil update OPD
        // ->press('[wire\:click="gotoPage(2, \'page\')"]') // navigasi ke halaman 2 untuk melihat data yang baru diedit
        ->assertSee('OPD Updated') // verifikasi OPD telah terupdate di daftar
        ->assertDontSee('OPD Test') // verifikasi nama lama tidak muncul lagi
        ->check('[aria-label="Select/deselect item 11 for bulk actions."]') // pilih OPD terbaru untuk dihapus
        ->pressAndWaitFor('Bulk actions', 1) // buka dropdonw bulk actions
        ->pressAndWaitFor('Delete selected', 1) // pilih delete selected
        ->press('Delete') // konfirmasi delete
        ->assertSee('Deleted'); // verifikasi OPD berhasil dihapus
});