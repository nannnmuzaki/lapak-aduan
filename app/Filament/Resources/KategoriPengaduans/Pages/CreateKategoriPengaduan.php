<?php

namespace App\Filament\Resources\KategoriPengaduans\Pages;

use App\Filament\Resources\KategoriPengaduans\KategoriPengaduanResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKategoriPengaduan extends CreateRecord
{
    protected static string $resource = KategoriPengaduanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTitle(): string
    {
        return 'Buat Kategori Pengaduan Baru';
    }
}
