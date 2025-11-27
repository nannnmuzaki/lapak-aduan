<?php

namespace App\Filament\Widgets;

use App\Models\Pengaduan;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PengaduanPerBulanChart extends ChartWidget
{
    protected ?string $heading = 'Pengaduan Per Bulan';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = collect();
        
        // Get data for last 12 months
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $count = Pengaduan::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
                
            $data->push([
                'month' => $date->format('M Y'),
                'count' => $count,
            ]);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pengaduan',
                    'data' => $data->pluck('count')->toArray(),
                    'backgroundColor' => '#f59e0b',
                    'borderColor' => '#f59e0b',
                    'tension' => 0.3,
                ],
            ],
            'labels' => $data->pluck('month')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
