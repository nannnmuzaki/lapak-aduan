<?php

namespace App\Filament\Resources\ChannelPengaduans;

use App\Filament\Resources\ChannelPengaduans\Pages\CreateChannelPengaduan;
use App\Filament\Resources\ChannelPengaduans\Pages\EditChannelPengaduan;
use App\Filament\Resources\ChannelPengaduans\Pages\ListChannelPengaduans;
use App\Filament\Resources\ChannelPengaduans\Schemas\ChannelPengaduanForm;
use App\Filament\Resources\ChannelPengaduans\Tables\ChannelPengaduansTable;
use App\Models\ChannelPengaduan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ChannelPengaduanResource extends Resource
{
    protected static ?string $model = ChannelPengaduan::class;

    protected static ?string $navigationLabel = 'Channel Pengaduan';

    protected static ?string $pluralModelLabel = 'Daftar Channel Pengaduan';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChatBubbleLeft;

    protected static ?string $recordTitleAttribute = 'nama';

    protected static string|UnitEnum|null $navigationGroup = 'Master Data';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return ChannelPengaduanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ChannelPengaduansTable::configure($table);
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
            'index' => ListChannelPengaduans::route('/'),
            'create' => CreateChannelPengaduan::route('/create'),
            'edit' => EditChannelPengaduan::route('/{record}/edit'),
        ];
    }
}
