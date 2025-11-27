<?php

namespace App\Filament\Resources\ChannelPengaduans\Pages;

use App\Filament\Resources\ChannelPengaduans\ChannelPengaduanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditChannelPengaduan extends EditRecord
{
    protected static string $resource = ChannelPengaduanResource::class;

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
        return 'Edit Channel Pengaduan';
    }
}
