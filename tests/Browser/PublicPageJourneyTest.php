<?php

use Database\Seeders\DatabaseSeeder;

beforeEach(function () {
    $this->seed(DatabaseSeeder::class);
});

test('Halaman Publik bisa diakses (Visitor Journey)', function () {
    visit('/')
        ->assertSee('Platform pengaduan masyarakat')
        ->navigate('/alur')
        ->assertSee('Verifikasi & Validasi')
        ->navigate('/daftar-opd')
        ->assertSee('Badan Penanggulangan Bencana Daerah')
        ->navigate('/daftar-pengaduan')
        ->assertSee('Antrian Panjang di Puskesmas Kelapa Dua')
        ->navigate('/statistik')
        ->assertSee('Perbandingan Status Verifikasi');
});