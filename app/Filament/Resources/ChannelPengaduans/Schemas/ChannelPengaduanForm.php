<?php

namespace App\Filament\Resources\ChannelPengaduans\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class ChannelPengaduanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->label('Nama Channel Pengaduan')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Contoh: Facebook, Instagram, Website, WhatsApp, dll'),
                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->rows(4)
                    ->columnSpanFull(),
            ]);
    }
}
