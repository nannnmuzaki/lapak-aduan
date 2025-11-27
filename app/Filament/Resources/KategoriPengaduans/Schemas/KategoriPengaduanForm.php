<?php

namespace App\Filament\Resources\KategoriPengaduans\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class KategoriPengaduanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama')
                    ->label('Nama Kategori Pengaduan')
                    ->required()
                    ->maxLength(255),
                Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->rows(4)
                    ->columnSpanFull(),
            ]);
    }
}
