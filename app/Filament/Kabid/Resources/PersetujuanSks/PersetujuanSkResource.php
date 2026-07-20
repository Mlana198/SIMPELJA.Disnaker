<?php

namespace App\Filament\Kabid\Resources\PersetujuanSks;

use App\Filament\Kabid\Resources\PersetujuanSks\Pages\EditPersetujuanSk;
use App\Filament\Kabid\Resources\PersetujuanSks\Pages\ListPersetujuanSks;
use App\Filament\Kabid\Resources\PersetujuanSks\Schemas\PersetujuanSkForm;
use App\Filament\Kabid\Resources\PersetujuanSks\Tables\PersetujuanSksTable;
use App\Models\Pendaftaran;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class PersetujuanSkResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCheckCircle;

    protected static string|UnitEnum|null $navigationGroup = 'Manajemen';

    protected static ?string $navigationLabel = 'Calon Peserta';

    protected static ?string $pluralModelLabel = 'Calon Peserta';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return PersetujuanSkForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PersetujuanSksTable::configure($table);
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
            'index' => ListPersetujuanSks::route('/'),
            'edit' => EditPersetujuanSk::route('/{record}/edit'),
        ];
    }
}
