<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\CheckboxList;

class RoleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Section::make('Informasi Role')
                    ->schema([
                        TextInput::make('name')
                            ->label('Nama Role')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->helperText('Nama role harus unik'),
                        TextInput::make('guard_name')
                            ->label('Guard Name')
                            ->default('web')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Default: web'),
                    ]),

                Section::make('Permissions')
                    ->schema([
                        CheckboxList::make('permissions')
                            ->label('Pilih Permissions')
                            ->relationship('permissions', 'name')
                            ->columns(3)
                            ->searchable()
                            ->bulkToggleable()
                            ->helperText('Pilih permissions yang dimiliki role ini'),
                    ]),
            ]);
    }
}
