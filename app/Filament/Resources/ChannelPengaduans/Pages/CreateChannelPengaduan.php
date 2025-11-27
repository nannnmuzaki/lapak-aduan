<?php

namespace App\Filament\Resources\ChannelPengaduans\Pages;

use App\Filament\Resources\ChannelPengaduans\ChannelPengaduanResource;
use Filament\Resources\Pages\CreateRecord;

class CreateChannelPengaduan extends CreateRecord
{
    protected static string $resource = ChannelPengaduanResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTitle(): string
    {
        return 'Buat Channel Pengaduan Baru';
    }
}
