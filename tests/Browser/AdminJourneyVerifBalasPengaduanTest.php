<?php

use App\Models\User;
use Database\Seeders\DatabaseSeeder;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

test('Admin journey verif & balas pengaduan', function () {
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
        ->pressAndWaitFor('View', 1) // buka detail pengaduan
        ->press('[title="Close"]') // tutup modal
        ->pressAndWaitFor('Verifikasi & Balas', 1) // buka modal form verifikasi dan balas
        ->assertSee('Verifikasi dan Balas Pengaduan') 
        ->press('[id="mountedActionSchema0.is_verified"]') // centang Verifikasi Pengaduan
        ->type('[role="textbox"]', 'Terima kasih atas laporannya. Kami akan segera menindaklanjuti masalah ini.')
        ->press('Verifikasi dan Balas Pengaduan') // press random agar keluar dari fokus textbox rich text editor
        ->select('.fi-modal [wire\:model*="status_respon"]', 'telah_direspon') // pilih status respon sebagai telah direspon
        ->press('Simpan') // simpan respon
        ->assertSee('Pengaduan berhasil diperbarui'); // verifikasi berhasil
});