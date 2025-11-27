<?php

namespace App\Filament\Widgets;

use App\Models\Pengaduan;
use Filament\Widgets\ChartWidget;

class PengaduanPerChannelChart extends ChartWidget
{
    protected ?string $heading = 'Pengaduan Per Channel';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $pengaduanPerChannel = Pengaduan::query()
            ->with('channelPengaduan')
            ->get()
            ->groupBy('channel_pengaduan_id')
            ->map(fn ($group) => [
                'count' => $group->count(),
                'channel' => $group->first()->channelPengaduan->nama ?? 'Unknown',
            ])
            ->sortByDesc('count')
            ->take(10);

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pengaduan',
                    'data' => $pengaduanPerChannel->pluck('count')->values()->toArray(),
                    'backgroundColor' => [
                        '#f59e0b',
                        '#3b82f6',
                        '#10b981',
                        '#ef4444',
                        '#8b5cf6',
                        '#ec4899',
                        '#14b8a6',
                        '#f97316',
                        '#6366f1',
                        '#84cc16',
                    ],
                ],
            ],
            'labels' => $pengaduanPerChannel->pluck('channel')->values()->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
