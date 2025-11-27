<?php

namespace App\Filament\Resources\Pengaduans\Pages;

use App\Filament\Resources\Pengaduans\PengaduanResource;
use App\Models\Pengaduan;
use Filament\Resources\Pages\CreateRecord;

class CreatePengaduan extends CreateRecord
{
    protected static string $resource = PengaduanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['nomor_pengaduan'] = Pengaduan::generateNomorPengaduan($data['channel_pengaduan_id']);

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
        return 'Buat Pengaduan Baru';
    }
}
