<?php

use App\Livewire\Pages\Home;
use App\Livewire\Pages\DaftarOpd;
use App\Livewire\Pages\AlurPengaduan;
use App\Livewire\Pages\BuatPengaduan;
use App\Livewire\Pages\DaftarPengaduan;
use App\Livewire\Pages\PengaduanSaya;
use App\Livewire\Pages\Statistik;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/daftar-opd', DaftarOpd::class)->name('page.daftar-opd');
Route::get('/alur', AlurPengaduan::class)->name('page.alur');
Route::get('/buat-pengaduan', BuatPengaduan::class)->middleware('auth')->name('page.buat-pengaduan');
Route::get('/daftar-pengaduan', DaftarPengaduan::class)->name('page.daftar-pengaduan');
Route::get('/pengaduan-saya', PengaduanSaya::class)->middleware('auth')->name('page.pengaduan-saya');
Route::get('/statistik', Statistik::class)->name('page.statistik');
