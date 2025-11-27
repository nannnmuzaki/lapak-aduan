<?php

namespace App\Filament\Resources\JenisPengaduans;

use App\Filament\Resources\JenisPengaduans\Pages\CreateJenisPengaduan;
use App\Filament\Resources\JenisPengaduans\Pages\EditJenisPengaduan;
use App\Filament\Resources\JenisPengaduans\Pages\ListJenisPengaduans;
use App\Filament\Resources\JenisPengaduans\Schemas\JenisPengaduanForm;
use App\Filament\Resources\JenisPengaduans\Tables\JenisPengaduansTable;
use App\Models\JenisPengaduan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class JenisPengaduanResource extends Resource
{
    protected static ?string $model = JenisPengaduan::class;

    protected static ?string $navigationLabel = 'Jenis Pengaduan';

    protected static ?string $pluralModelLabel = 'Daftar Jenis Pengaduan';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama';

    protected static string|UnitEnum|null $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return JenisPengaduanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JenisPengaduansTable::configure($table);
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
            'index' => ListJenisPengaduans::route('/'),
            'create' => CreateJenisPengaduan::route('/create'),
            'edit' => EditJenisPengaduan::route('/{record}/edit'),
        ];
    }
}
