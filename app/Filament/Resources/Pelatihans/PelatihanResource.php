<?php

namespace App\Filament\Resources\Pelatihans;

use App\Filament\Resources\Pelatihans\Pages\CreatePelatihan;
use App\Filament\Resources\Pelatihans\Pages\EditPelatihan;
use App\Filament\Resources\Pelatihans\Pages\ListPelatihans;
use App\Filament\Resources\Pelatihans\Schemas\PelatihanForm;
use App\Filament\Resources\Pelatihans\Tables\PelatihansTable;
use App\Models\Pelatihan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PelatihanResource extends Resource
{
    protected static ?string $model = Pelatihan::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedAcademicCap;

    protected static ?string $navigationLabel = 'Pelatihan';

    protected static \UnitEnum|string|null $navigationGroup = 'Konten';

    protected static ?string $slug = 'konten-pelatihan';

    public static ?string $label = 'Pelatihan';

    protected static ?string $recordTitleAttribute = 'nama_pelatihan';

    public static function form(Schema $schema): Schema
    {
        return PelatihanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PelatihansTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\DokumenPelatihansRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPelatihans::route('/'),
            'create' => CreatePelatihan::route('/create'),
            'edit' => EditPelatihan::route('/{record}/edit'),
        ];
    }
}
