<?php

namespace App\Filament\Resources\Kelulusans;

// use App\Filament\Resources\Kelulusans\Pages\CreateKelulusan;
use App\Filament\Resources\Kelulusans\Pages\EditKelulusan;
use App\Filament\Resources\Kelulusans\Pages\ListKelulusans;
use App\Filament\Resources\Kelulusans\Schemas\KelulusanForm;
use App\Filament\Resources\Kelulusans\Tables\KelulusansTable;
use App\Models\Pendaftaran;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class KelulusanResource extends Resource
{
    protected static ?string $model = Pendaftaran::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static string|UnitEnum|null $navigationGroup = 'Manajemen';

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationLabel = 'Kelulusan';

    protected static ?string $pluralModelLabel = 'Kelulusan';

    protected static ?string $slug = 'manajemen-kelulusan';

    protected static ?string $recordTitleAttribute = 'id';

    public static function form(Schema $schema): Schema
    {
        return KelulusanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KelulusansTable::configure($table);
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
            'index' => ListKelulusans::route('/'),
            // 'create' => CreateKelulusan::route('/create'),
            'edit' => EditKelulusan::route('/{record}/edit'),
        ];
    }
}
