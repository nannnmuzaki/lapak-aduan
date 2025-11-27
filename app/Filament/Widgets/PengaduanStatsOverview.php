<?php

namespace App\Filament\Widgets;

use App\Models\Pengaduan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PengaduanStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalPengaduan = Pengaduan::count();
        $pengaduanBulanIni = Pengaduan::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();
        $pengaduanDalamProses = Pengaduan::where('status_respon', 'dalam_proses')->count();
        $pengaduanSelesai = Pengaduan::where('status_respon', 'telah_direspon')->count();
        $pengaduanTerverifikasi = Pengaduan::where('is_verified', true)->count();
        $pengaduanPerluTindakLanjut = Pengaduan::where('perlu_tindak_lanjut', true)
            ->where('status_tindak_lanjut', '!=', 'sudah_ditindak_lanjuti')
            ->count();

        return [
            Stat::make('Total Pengaduan', $totalPengaduan)
                ->description('Total semua pengaduan')
                ->descriptionIcon('heroicon-o-document-text')
                ->color('primary')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),
                
            Stat::make('Pengaduan Bulan Ini', $pengaduanBulanIni)
                ->description('Pengaduan di bulan ' . now()->format('F Y'))
                ->descriptionIcon('heroicon-o-calendar')
                ->color('success'),
                
            Stat::make('Dalam Proses', $pengaduanDalamProses)
                ->description('Menunggu respon')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),
                
            Stat::make('Telah Direspon', $pengaduanSelesai)
                ->description('Sudah ada respon')
                ->descriptionIcon('heroicon-o-check-circle')
                ->color('success'),
                
            Stat::make('Terverifikasi', $pengaduanTerverifikasi)
                ->description('Pengaduan yang sudah diverifikasi')
                ->descriptionIcon('heroicon-o-shield-check')
                ->color('info'),
                
            Stat::make('Perlu Tindak Lanjut', $pengaduanPerluTindakLanjut)
                ->description('Memerlukan tindak lanjut')
                ->descriptionIcon('heroicon-o-exclamation-triangle')
                ->color('danger'),
        ];
    }
}
