<?php

use App\Models\User;
use Database\Seeders\DatabaseSeeder;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

test('Admin journey balas pengaduan', function () {
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
        ->assertSee('Sampah menumpuk di TPS')
        ->pressAndWaitFor('Verifikasi & Balas', 1)
        ->assertSee('Verifikasi dan Balas Pengaduan')
        ->type('[role="textbox"]', 'Terima kasih atas laporannya. Kami akan segera menindaklanjuti masalah ini.')
        ->press('Verifikasi dan Balas Pengaduan')
        ->select('.fi-modal [wire\:model*="status_respon"]', 'dalam_proses')
        ->press('Simpan')
        ->assertSee('Pengaduan berhasil diperbarui');
});