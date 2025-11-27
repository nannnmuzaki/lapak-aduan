<?php

namespace App\Filament\Resources\JenisPengaduans\Pages;

use App\Filament\Resources\JenisPengaduans\JenisPengaduanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJenisPengaduans extends ListRecords
{
    protected static string $resource = JenisPengaduanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Buat Jenis Pengaduan Baru'),
        ];
    }
}
