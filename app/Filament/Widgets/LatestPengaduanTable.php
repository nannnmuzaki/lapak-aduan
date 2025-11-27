<?php

namespace App\Filament\Widgets;

use App\Models\Pengaduan;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestPengaduanTable extends BaseWidget
{
    protected static ?int $sort = 4;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Pengaduan::query()
                    ->latest()
                    ->limit(10)
            )
            ->columns([
                Tables\Columns\TextColumn::make('nomor_pengaduan')
                    ->label('Nomor')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('judul')
                    ->label('Judul')
                    ->limit(40)
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('nama_pengadu')
                    ->label('Pengadu')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('channelPengaduan.nama')
                    ->label('Channel')
                    ->badge()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status_respon')
                    ->label('Status')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'dalam_proses' => 'Dalam Proses',
                        'telah_direspon' => 'Telah Direspon',
                    })
                    ->colors([
                        'warning' => 'dalam_proses',
                        'success' => 'telah_direspon',
                    ]),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ]);
    }

    protected function getTableHeading(): string
    {
        return 'Pengaduan Terbaru';
    }
}
