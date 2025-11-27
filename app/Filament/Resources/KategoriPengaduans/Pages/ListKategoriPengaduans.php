<?php

namespace App\Filament\Resources\KategoriPengaduans\Pages;

use App\Filament\Resources\KategoriPengaduans\KategoriPengaduanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKategoriPengaduans extends ListRecords
{
    protected static string $resource = KategoriPengaduanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Buat Kategori Pengaduan Baru'),
        ];
    }
}
