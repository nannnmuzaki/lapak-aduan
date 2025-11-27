<?php

namespace App\Filament\Resources\Opds\Pages;

use App\Filament\Resources\Opds\OpdResource;
use Filament\Resources\Pages\CreateRecord;

class CreateOpd extends CreateRecord
{
    protected static string $resource = OpdResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTitle(): string
    {
        return 'Buat OPD Baru';
    }
}
