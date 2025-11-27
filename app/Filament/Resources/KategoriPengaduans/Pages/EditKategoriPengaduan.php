<?php

namespace App\Filament\Resources\KategoriPengaduans\Pages;

use App\Filament\Resources\KategoriPengaduans\KategoriPengaduanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKategoriPengaduan extends EditRecord
{
    protected static string $resource = KategoriPengaduanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTitle(): string
    {
        return 'Edit Kategori Pengaduan';
    }
}
