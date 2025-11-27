<?php

namespace App\Filament\Resources\Opds;

use App\Filament\Resources\Opds\Pages\CreateOpd;
use App\Filament\Resources\Opds\Pages\EditOpd;
use App\Filament\Resources\Opds\Pages\ListOpds;
use App\Filament\Resources\Opds\Schemas\OpdForm;
use App\Filament\Resources\Opds\Tables\OpdsTable;
use App\Models\Opd;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class OpdResource extends Resource
{
    protected static ?string $model = Opd::class;

    protected static ?string $navigationLabel = 'OPD';
    
    protected static ?string $pluralModelLabel = 'Daftar OPD';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingLibrary;

    protected static ?string $recordTitleAttribute = 'nama';

    protected static string|UnitEnum|null $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return OpdForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return OpdsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListOpds::route('/'),
            'create' => CreateOpd::route('/create'),
            'edit' => EditOpd::route('/{record}/edit'),
        ];
    }
}
