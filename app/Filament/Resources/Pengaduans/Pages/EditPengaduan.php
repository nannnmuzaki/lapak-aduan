<?php

namespace App\Filament\Resources\Pengaduans\Pages;

use App\Filament\Resources\Pengaduans\PengaduanResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Models\Pengaduan;
use Illuminate\Support\Facades\Log;

class EditPengaduan extends EditRecord
{
    protected static string $resource = PengaduanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Check if channel_pengaduan_id has changed
        if (isset($data['channel_pengaduan_id']) && 
            $this->record->getOriginal('channel_pengaduan_id') !== $data['channel_pengaduan_id']) {
            
            // Regenerate nomor_pengaduan if channel changed
            $data['nomor_pengaduan'] = Pengaduan::generateNomorPengaduan($data['channel_pengaduan_id']);

        }

        if ($data['perlu_tindak_lanjut'] && !isset($data['status_tindak_lanjut'])) 
        {
            $data['status_tindak_lanjut'] = 'belum_ditindak_lanjuti';
        }

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public function getTitle(): string
    {
        return 'Edit Pengaduan';
    }
}