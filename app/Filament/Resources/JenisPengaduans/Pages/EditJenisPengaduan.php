<?php

namespace App\Filament\Resources\JenisPengaduans\Pages;

use App\Filament\Resources\JenisPengaduans\JenisPengaduanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditJenisPengaduan extends EditRecord
{
    protected static string $resource = JenisPengaduanResource::class;

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
        return 'Edit Jenis Pengaduan';
    }
}
