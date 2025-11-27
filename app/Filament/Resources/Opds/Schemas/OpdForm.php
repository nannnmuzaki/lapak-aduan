<?php

namespace App\Filament\Resources\Opds\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;

class OpdForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi OPD')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('nama')
                                    ->label('Nama OPD')
                                    ->required()
                                    ->maxLength(255)
                                    ->helperText('Nama lengkap Organisasi Perangkat Daerah'),
                                TextInput::make('kode')
                                    ->label('Kode OPD')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->maxLength(255)
                                    ->helperText('Kode unik untuk OPD ini'),
                            ]),
                        Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Informasi Kontak')
                    ->schema([
                        TextInput::make('alamat')
                            ->label('Alamat')
                            ->maxLength(255),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('telepon')
                                    ->label('Telepon')
                                    ->tel()
                                    ->maxLength(255),
                                TextInput::make('email')
                                    ->label('Email')
                                    ->email()
                                    ->maxLength(255),
                            ]),
                    ]),
            ]);
    }
}
