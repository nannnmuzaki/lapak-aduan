<?php

use App\Models\User;
use Database\Seeders\DatabaseSeeder;


beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

test('User Journey buat pengaduan baru (Pengaduan CRUD)', function () {
    $user = User::where('email', 'rina.marlina@gmail.com')->first();

    visit('/')
        ->assertSee('Platform pengaduan masyarakat')
        ->assertDontSee('Pengaduan Saya')
        ->navigate('/buat-pengaduan')
        ->assertPathIs('/main/login')
        ->type('[wire\:model="data.email"]', $user->email)
        ->type('[wire\:model="data.password"]', 'password')
        ->submit()
        ->assertPathIs('/')
        ->assertSee('Pengaduan Saya')
        ->navigate('/buat-pengaduan')
        ->type('[wire\:model="nama_pengadu"]', 'John Pork')
        ->type('[wire\:model="email_pengadu"]', 'john.doe@example.com')
        ->type('[wire\:model="telepon_pengadu"]', '081234567890')
        ->type('[wire\:model="judul"]', 'Sampah Menumpuk di Jalan Raya')
        ->select('[wire\:model="jenis_pengaduan_id"]', '3')
        ->select('[wire\:model="kategori_pengaduan_id"]', '5')
        ->select('[wire\:model="opd_id"]', '4')
        ->type('[wire\:model="isi"]', 'Saya ingin melaporkan bahwa sampah menumpuk di jalan raya dekat rumah saya dan belum diangkut selama seminggu terakhir.')
        ->pressAndWaitFor('Kirim Pengaduan', 2)
        ->navigate('/pengaduan-saya')
        ->assertSee('Sampah Menumpuk di Jalan Raya')
        ->press('Hapus')
        ->assertSee('Hapus Pengaduan?')
        ->press('[wire\:click="deletePengaduan"]')
        ->assertSee('Pengaduan berhasil dihapus')
        ->assertDontSee('Sampah Menumpuk di Jalan Raya');
});