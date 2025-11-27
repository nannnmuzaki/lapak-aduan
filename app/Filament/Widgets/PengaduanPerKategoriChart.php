<?php

namespace App\Filament\Widgets;

use App\Models\Pengaduan;
use Filament\Widgets\ChartWidget;

class PengaduanPerKategoriChart extends ChartWidget
{
    protected ?string $heading = 'Pengaduan Per Kategori';

    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 'full';

    protected function getData(): array
    {
        $pengaduanPerKategori = Pengaduan::query()
            ->with('kategoriPengaduan')
            ->get()
            ->groupBy('kategori_pengaduan_id')
            ->map(fn ($group) => [
                'count' => $group->count(),
                'kategori' => $group->first()->kategoriPengaduan->nama ?? 'Unknown',
            ])
            ->sortByDesc('count');

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pengaduan',
                    'data' => $pengaduanPerKategori->pluck('count')->values()->toArray(),
                    'backgroundColor' => '#f59e0b',
                ],
            ],
            'labels' => $pengaduanPerKategori->pluck('kategori')->values()->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
