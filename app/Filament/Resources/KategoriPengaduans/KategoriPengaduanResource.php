<?php

namespace App\Filament\Resources\KategoriPengaduans;

use App\Filament\Resources\KategoriPengaduans\Pages\CreateKategoriPengaduan;
use App\Filament\Resources\KategoriPengaduans\Pages\EditKategoriPengaduan;
use App\Filament\Resources\KategoriPengaduans\Pages\ListKategoriPengaduans;
use App\Filament\Resources\KategoriPengaduans\Schemas\KategoriPengaduanForm;
use App\Filament\Resources\KategoriPengaduans\Tables\KategoriPengaduansTable;
use App\Models\KategoriPengaduan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class KategoriPengaduanResource extends Resource
{
    protected static ?string $model = KategoriPengaduan::class;

    protected static ?string $navigationLabel = 'Kategori Pengaduan';

    protected static ?string $pluralModelLabel = 'Daftar Kategori Pengaduan';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedFolder;

    protected static ?string $recordTitleAttribute = 'nama';

    protected static string|UnitEnum|null $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return KategoriPengaduanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KategoriPengaduansTable::configure($table);
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
            'index' => ListKategoriPengaduans::route('/'),
            'create' => CreateKategoriPengaduan::route('/create'),
            'edit' => EditKategoriPengaduan::route('/{record}/edit'),
        ];
    }
}
