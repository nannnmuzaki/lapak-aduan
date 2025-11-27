<?php

namespace App\Filament\Resources\ChannelPengaduans\Pages;

use App\Filament\Resources\ChannelPengaduans\ChannelPengaduanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListChannelPengaduans extends ListRecords
{
    protected static string $resource = ChannelPengaduanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Buat Channel Pengaduan Baru'),
        ];
    }
}
