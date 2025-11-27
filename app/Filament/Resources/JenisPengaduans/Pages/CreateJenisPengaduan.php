<?php

namespace App\Filament\Resources\JenisPengaduans\Pages;

use App\Filament\Resources\JenisPengaduans\JenisPengaduanResource;
use Filament\Resources\Pages\CreateRecord;

class CreateJenisPengaduan extends CreateRecord
{
    protected static string $resource = JenisPengaduanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTitle(): string
    {
        return 'Buat Jenis Pengaduan Baru'; 
    }
}
