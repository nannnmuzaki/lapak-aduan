<?php

namespace App\Livewire\Pages;

use App\Models\Pengaduan;
use App\Models\Opd;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Home extends Component
{
    #[Layout('components.layouts.app')]
    #[Title('Beranda - Lapak Aduan Kabupaten Banyumas')]
    public function render()
    {
        $totalPengaduan = Pengaduan::count();
        $pengaduanDirespon = Pengaduan::where('status_respon', 'telah_direspon')->count();
        $pengaduanDiproses = Pengaduan::where('status_respon', 'dalam_proses')->count();
        $totalOpd = Opd::count();
        
        $recentPengaduan = Pengaduan::where('is_pengaduan_public', true)
            ->where('is_verified', true)
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.pages.home', [
            'totalPengaduan' => $totalPengaduan,
            'pengaduanDirespon' => $pengaduanDirespon,
            'pengaduanDiproses' => $pengaduanDiproses,
            'totalOpd' => $totalOpd,
            'recentPengaduan' => $recentPengaduan,
        ]);
    }
}
